@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Login</h2>
    <form id="loginForm">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="justify-content-center text-center">
            <button type="submit" class="btn btn-primary">Login</button>
            <button type="button" class="btn btn-secondary" id="forgotPasswordButton">Esqueci minha senha</button>
        </div>
    </form>
</div>

<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel"><span class="badge text-bg-danger">Erro</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="errorModalBody">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel"><span class="badge text-bg-success">Sucesso</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Login bem-sucedido!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('login') }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    localStorage.setItem('auth_token', response.access_token);
                    $('#successModal').modal('show');
                    setTimeout(function() {
                        window.location.href = '{{ route('home') }}'; 
                    }, 2000);
                },
                error: function(response) {
                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        let errorMessages = '';
                        for (let field in errors) {
                            if (errors.hasOwnProperty(field)) {
                                errors[field].forEach(function(error) {
                                    errorMessages += '<p>' + error + '</p>';
                                });
                            }
                        }
                        $('#errorModalBody').html(errorMessages);
                        $('#errorModal').modal('show');
                    } else {
                        alert('Falha no login');
                    }
                }
            });
        });

        $('#forgotPasswordButton').on('click', function() {
            window.location.href = '{{ route('password.request') }}';
        });

        $('.close').click(function() {
            $('#errorModal').modal('hide');
            $('#successModal').modal('hide');
        });
    });
</script>
@endsection

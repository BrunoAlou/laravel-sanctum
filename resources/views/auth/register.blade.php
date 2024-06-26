@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Register</h2>
    <form id="registerForm">
        @csrf
        <div class="form-group">
            <label for="name">Nome Completo</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirme a senha</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div class="form-group">
            <label for="zip">CEP</label>
            <input type="text" class="form-control" id="zip" name="zip" required>
            <span id="zipLoading" style="display:none;">Carregando...</span>
            <label id="zipError" style="display:none; color:red;">CEP não encontrado</label>
        </div>
        <div class="form-group">
            <label for="address">Endereço</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <button type="submit" class="btn btn-primary" id="registerButton" disabled>Registro</button>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Message</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalMessage"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    function debounce(func, wait, immediate) {
        let timeout;
        return function() {
            const context = this, args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    function validateForm() {
        let isValid = true;
        $('#registerForm input[required]').each(function() {
            if ($(this).val() === '') {
                isValid = false;
            }
        });
        $('#registerButton').attr('disabled', !isValid);
    }

    $('#registerForm input[required]').on('input', validateForm);

    const checkZipCode = debounce(function() {
        const zip = $('#zip').val();
        if (zip.length === 8) {
            $('#zipLoading').show();
            $('#zipError').hide();

            $.ajax({
                url: '/api/get-address/' + zip,
                type: 'GET',
                success: function(response) {
                    $('#zipLoading').hide();
                    if (response) {
                        $('#address').val(`Logradouro: ${response.logradouro}, Bairro: ${response.bairro}, ${response.localidade}-${response.uf}`);
                        validateForm();
                    } else {
                        $('#address').val('');
                        $('#zipError').show();
                    }
                },
                error: function() {
                    $('#zipLoading').hide();
                    $('#zipError').show();
                }
            });
        }
    }, 500);

    $('#zip').on('input', checkZipCode);

    $('#registerForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route('register') }}',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#modalMessage').text(response.message);
                $('#messageModal').modal('show');
            },
            error: function(response) {
                let errorMessages = '';
                $.each(response.responseJSON.errors, function(key, value) {
                    errorMessages += value[0] + '<br>';
                });
                $('#modalMessage').html(errorMessages);
                $('#messageModal').modal('show');
            }
        });
    });

    $('.close').click(function() {
        $('#messageModal').modal('hide');
    });
});
</script>
@endsection
# Projeto Laravel com Autenticação Sanctum

Este projeto é uma aplicação web desenvolvida em Laravel, utilizando o pacote Sanctum para autenticação via API. A aplicação inclui páginas de cadastro, login, recuperação de senha e uma página inicial que lista todos os usuários cadastrados.

## Funcionalidades

- **Página de Cadastro**: Permite registrar novos usuários com nome completo, e-mail, senha, confirmação de senha e endereço.
- **Página de Login**: Autenticação de usuários utilizando Sanctum.
- **Recuperação de Senha**: Funcionalidade para enviar e-mail de recuperação de senha.
- **Página Home**: Exibe todos os usuários cadastrados no sistema.

## Tecnologias Utilizadas

- **Laravel**: Framework PHP para desenvolvimento web.
- **Sanctum**: Pacote Laravel para autenticação via tokens.
- **AJAX**: Comunicação entre frontend e backend para validações e operações assíncronas.
- **API de Endereço via CEP**: Integração para preenchimento automático de endereço a partir do CEP.

## Estrutura do Projeto

O projeto segue os princípios SOLID e utiliza os seguintes componentes:

- **Controllers**: Controlam o fluxo de requisições.
- **Services**: Lógica de negócio separada dos controllers.
- **Events**: Disparados após eventos significativos, como registro de novo usuário.
- **Requests**: Validação de dados de entrada.
- **Providers**: Integração de serviços externos, como a API de endereço via CEP.

## Instalação e Configuração

1. Clone o repositório:
   ```bash
   git clone git@github.com:BrunoAlou/laravel-sanctum.git
2. Instale as dependências do Composer:
    ```bash
    composer install
3. Configure o arquivo .env com as credenciais do banco de dados e outras configurações necessárias.
4. Adicione um arquivo database.sqlite dentro da pasta database para utilizar o SQLite como banco de dados.
5. Execute as migrações do banco de dados e inicie o servidor:
    ```bash
    php artisan migrate
    php artisan serve
6. Acesse a aplicação através do navegador:
http://localhost:8000


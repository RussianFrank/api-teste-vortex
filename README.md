
# Teste Vortex

API Laravel de comunicação de sistemas via email
com autenticação JWT, integração com mailgun e
mecanismo de job/filas

## Requisitos
```http
  PHP 8.1
  Composer 2+
```

## Setup no projeto

```http
  composer install
```
```http
  cp .env.example .env
  php artisan key:generate
  php artisan migrate
  php artisan jwt:secret
```
#### Após rodar o comando do jwt, pegue o token gerado e insira no .env `JWT_SECRET`, caso já não esteja lá

#### Gerar usuário de teste

```http
  php artisan db:seed --class=UserSeeder
```
##### Depois de gerar o usuário, use as credenciais geradas no terminal para a autenticação

#### iniciar o servidor
```http
  php artisan serve
```
#### iniciar a fila
```http
  php artisan queue:work
```

## Considerações da API

Para a autenticação resolvi utilizar o JWT pela praticidade
de integração com Laravel e segurança mais sólida

### Gerar o Bearer token

```http
  POST /api/v1/auth/autenticar
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `email` | `string` | **Obrigatório**.|
| `password` | `string` | **Obrigatório**.|


### Agendar/Disparar email

```http
  POST /api/v1/email/agendar
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `nome` | `string` | **Obrigatório**.|
| `email` | `string` | **Obrigatório**.|
| `assunto` | `string` | **Obrigatório**.|
| `corpo_email` | `string` | **Obrigatório**.|
| `agendar` | `string/DateTime` | **Opcional**.|

```http
  Bearer 'SEU_TOKEN'
```
### Retorna todos os emails disparados deste usuário

```http
  GET /api/v1/email/historico
```
```http
  Bearer 'SEU_TOKEN'
```

## Testes

```http
  php artisan test
```
#### Ou
```http
  ./vendor/bin/phpunit
```


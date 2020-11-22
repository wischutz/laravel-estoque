PROJETO DE TESTE - CADASTRO DE PRODUTOS E CONTROLE DE ESTOQUE

https://github.com/wischutz/laravel-estoque
William Schütz - wischutz@gmail.com


Desenvolvido na versão 11.3.3 do homestead
https://github.com/laravel/homestead/releases/tag/v11.3.3

Laravel 8.15.0
PHP 7.4.11
MySql 5.7.31

Após clonar o repositório e configurar um banco de dados no arquivo .env rode o comando abaixo para rodar as migration e o seed de dados de teste

php artisan migrate --seed

Autenticação na aplicação:
Após esse processo, o login com as credenciais abaixo estará apto

test@test.com:test

Autenticação na api:
Para possibilitar o login do usuário acima na API, é necessário gerar um token JWT com o comando abaixo

php artisan jwt:secret

Com isso será possível gerar o token para acesso à api no endpoint /login com os dados abaixo

{host}/api/auth/login

Método=POST

email:test@test.com
password:test

Para realizar as requisições nos endpoints de ordens de produto, é necessário informar o bearer token gerado no processo acima na autorização, juntamente com os parâmetros abaixo na request

{host}/api/adicionar-produtos
{host}/api/baixar-produtos

Método=POST

product_id:2
amount:1542

Para facilitar, a collection de requests utilizadas nos testes no postman foram exportadas no arquivo estoque_laravel.postman_collection.json na raiz desse projeto.
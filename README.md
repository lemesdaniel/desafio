## O que foi utilizado

1. Um container docker com php 7.4
2. Banco de dados.
3. Symfony para prover rotas e a injeção de dependência.
4. Doctrine apenas pela integração com symfony e então foi utilizado PDO

> As escolhas se basearam na simplicidade pra que o foco ficasse no código e não na tecnologia utilizada.
> Algumas tecnologias eu nunca havia utilizado, como Symfony 5 e Doctrine

### Instruções

Nessa instruções presumisse que já se tenha o docker instalado.

Se você estiver utilizando linux utilize o comando _docker-compose up -d_ para subir a aplicação e acesse através da url http://localhost:9000.

Para realizar um cadastro podemos usar o script shell abaixo

> Existe um arquivo do [insomnia](https://insomnia.rest/download) dentro da pasta [doc/insomnia](https://github.com/lemesdaniel/desafio/tree/main/doc/insomnia) 

``` 
curl --request POST \
--url http://localhost:9000/user \
--header 'Content-Type: application/json' \
--data '{
"document" : "51671366280",
"name" : "Daniel Lemes",
"email" : "dlemesdev@gmail.com",
"password": "123456"
}'
``` 

Buscar usuário 

```
curl --request GET \
  --url http://desafio.test:9000/user/38
``` 

Buscar saldo da carteira
```
curl --request GET \
--url http://desafio.test:9000/wallet \
--header 'Content-Type: application/json' \
--data '{
"user_id":"41"
}'
```

Gerar transação

```
curl --request POST \
--url http://desafio.test:9000/transaction \
--header 'Content-Type: application/json' \
--data '{
"payer": 41,
"payee": 45,
"value": 189.99
}'
```


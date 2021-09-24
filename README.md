###Instruções

O projeto usa docker e banco de dados sqlite, para fins de simplicidade não foi implantado o um servidor web e o projeto roda com o servidor built-in do php na porta 9000

Se você estiver utilizando linux utilize o comando _docker-compose up -d_ para subir a aplicação e acesse através da url http://localhost:9000.

Para realizar um cadastro podemos usar o script shell abaixo

curl --request POST \
--url http://localhost:9000/user \
--header 'Content-Type: application/json' \
--data '{
"document" : "51671366280",
"name" : "Daniel Lemes",
"email" : "dlemesdev@gmail.com",
"password": "123456"
}'



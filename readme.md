# Projeto PHP+Laravel com Angular 1.5.0
Este projeto foi feito utilizando PHP+Laravel com Angular 1.5.0 e HTML5. Foi utilizado nesse projeto o servidor de aplicação XAMPP.
##### Instalação
Para instalar o projeto e roda-lo sigas os passos abaixo em sequencia:
- 1° Baixe e instale o XAMPP
- 2° Baixe ou clone este projeto
- 3° Coloque o projeto dentro da pasta htdocs do XAMPP
- 4° Abra o cmd, entre na basta e utilize o comando **composer install**
- 5° Na raiz do XAMPP acesse apache/conf/extra e abra o arquivo httpd-vhosts.conf
- 6° Adicione o comando abaixo no fim do arquivo:
```
<VirtualHost *:80>
	ServerName phplaravel.test
	DocumentRoot "<DIRETORIO DO XAMPP>\htdocs\Simple-PHP-Laravel-Angular-Project\public"
	<Directory "<DIRETORIO DO XAMPP>\htdocs\Simple-PHP-Laravel-Angular-Project\public">
		AllowOverride all
	</Directory>
</VirtualHost>
```
- 7° Feito isso acesse a pasta windows/System32/drivers/etc e abra o arquivo hosts
- 8° Adicione o comando abaixo no fim do arquivo:
```
127.0.0.1 phplaravel.test
```
- 9° Feito isso inicialize o XAMPP
- 10° Acesse o banco de dados MySQL e crie a base de dados laraveldb com o comando abaixo:
```
create database laraveldb;
```
- 11° Criado a base de dados vá até a pasta do projeto
- 12° Configure o acesso do Banco de Dados através do arquivos .env na raiz e na pasta /conf o arquivo database.php
- 13° Abra o CMD do Windows e acesse a pasta do projeto.
- 14° Digite o comando "php artisan migrate".
- 15° Esse comando ira adicionar as tabelas necessárias para o projeto."
- 16° Digite no navegador o link **phplaravel.test** pronto!!!

<h1>Projeto PHP+Laravel com Angular 1.5.0</h1>
<p>Este projeto foi feito utilizando PHP+Laravel com Angular 1.5.0 e HTML5. Foi utilizado nesse projeto o servidor de aplicação XAMPP.</p>
<h2>Instalação</h2>
<p>Para instalar o projeto e roda-lo sigas os passos abaixo em sequencia:</p>
<p>1° Baixe e instale o XAMPP</p>
<p>2° Baixe ou clone este projeto</p>
<p>3° Coloque o projeto dentro da pasta htdocs do XAMPP</p>
<p>4° Na raiz do XAMPP acesse apache/conf/extra e abra o arquivo httpd-vhosts.conf</p>
<p>5° Adicione o comando abaixo no fim do arquivo:</p>
```
<VirtualHost *:80>
	ServerName phplaravel.test
	DocumentRoot "<DIRETORIO DO XAMPP>\htdocs\Simple-PHP-Laravel-Angular-Project\public"
	<Directory "<DIRETORIO DO XAMPP>\htdocs\Simple-PHP-Laravel-Angular-Project\public">
		AllowOverride all
	</Directory>
</VirtualHost>
```
<p>6° Feito isso acesse a pasta windows/System32/drivers/etc e abra o arquivo hosts</p>
<p>7° Adicione o comando abaixo no fim do arquivo:</p>
127.0.0.1 phplaravel.test
<p>8° Feito isso inicialize o XAMPP</p>
<p>9° Acesse o banco de dados MySQL e crie a base de dados laraveldb com o comando abaixo:</p>
create database laraveldb;
<p>10° Criado a base de dados vá até a pasta do projeto</p>
<p>11° Configure o acesso do Banco de Dados através do arquivos .env na raiz e na pasta /conf o arquivo database.php</p>
<p>12° Abra o CMD do Windows e acesse a pasta do projeto.</p>
<p>13° Digite o comando "php artisan migrate".</p>
<p>13° Esse comando ira adicionar as tabelas necessárias para o projeto."</p>

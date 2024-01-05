# Gerenciador de notas fiscais

## Como instalar

Required software:
- PHP 8.1
- Composer 2
- Docker
- docker-compose

Apesar do sistema rodar no docker para poder iniciar o sistema é necessário ter o PHP 8.1 e o compositor 2 instalados.
Este software é executado com a ajuda do [Laravel Sail](https://laravel.com/docs/10.x/sail#main-content). Depois de ter todo o software necessário instalado, você deve criar um
alias para Laravel Sail, ele pode ser encontrado neste artigo [Configurando um alias de shell](https://laravel.com/docs/10.x/sail#configurando-a-shell-alias).

Dentro da pasta raiz do projeto você deve executar `composer install` seguido de `sail up`. Esses dois comandos irão
instalar todas as dependências e criar os contêineres docker. Você deve criar uma cópia do arquivo .env.example dentro
a pasta raiz chamada apenas .env.
Como passo final você deve executar 

Comandos necessários
- `composer install`
- `vendor/bin/sail up -d`
- `cp .env.example .env`

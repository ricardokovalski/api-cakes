## Sobre o sistema

Este sistema foi desenvolvido utilizando PHP (7.3.*) e o Laravel em sua última versão.

Após realizar o clone do repositório, digite o comando abaixo na raíz do projeto:

```composer install```

Depois que terminar a instalação, rode o camando abaixo para criar o arquivo .env

```cp .env.example .env```

Alterar a variável no .env

```
QUEUE_CONNECTION=redis
```

E posteriormente rode o comando abaixo para gerar a key da sua aplicação:

```php artisan key:generate```

Após configure um banco de dados e preencha os dados de acesso do mesmo no arquivo .env e em seguida rode as migrations com o seguinte comando:

```php artisan migrate```

Para criar dados de teste, rode o comando abaixo:

```ptp artisan db:seed --class=CakeTableSeeder```

## A Api

```php artisan l5-swagger:generate```

Acessar /api/documentation

## Observações

Sempre rodar as fila com:

```php artisan queue:work```

Utilizei o laradock com os containers:

* php-fpm
* nginx
* mysql
* redis

Para envio de email, utilizei o [Mailtrap](https://mailtrap.io/).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

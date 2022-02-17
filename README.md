
# Desafio CRUD de produtos Promobit

Criação de CRUD de produtos, tags e extração de relatório de relevância de produtos.

# Requisitos

- [PHP 8+](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/download/)
- [Node v16.4.*](https://nodejs.org/en/)

# Instalação 

```bash
composer install
npm i && npm run dev
```

Acessar a pasta do projeto

```bash
cp .env.exemple .env
php artisan key:generate
php artisan migrate

php arisan serve
```

# Relatório Tag sumarizador de product

```SQL
select t.name,
       count(`products`.id) as Quantity_product
from `products`
         inner join `products_tags` on `products`.`id` = `products_tags`.`product_id`
         inner join tags t on products_tags.tag_id = t.id
group by t.name
``` 

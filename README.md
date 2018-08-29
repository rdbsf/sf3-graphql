## basic setup for Symfony 3 + MySql using GraphQL

GraphQL Bundles used

```
composer require overblog/graphql-bundle
composer require --dev overblog/graphiql-bundle
```

PHP 5.6 required

#### Symfony mods

moved cache/logs out of vagrant shared folder as recommended

#### Entities
Built using https://symfony.com/doc/3.4/doctrine.html

php bin/console doctrine:schema:update --force -e dev

####  add a single book w/ author
https://sf3.local/app_dev.php/add


#### GraphiQL
http://sf3.local:8000/app_dev.php/graphiql


Example query

```
{
  book(id:1){
  title,
   description, 
   authors {
      name, 
      bio
    }
  }
}
```

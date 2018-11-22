## basic setup for Symfony 3 + MySql + React using GraphQL


#### Entities
Built using https://symfony.com/doc/3.4/doctrine.html

php bin/console doctrine:schema:update --force -e dev


# Symfony mods

moved cache/logs out of vagrant shared folder as recommended

Entities built with https://symfony.com/doc/3.4/doctrine.html

# create db first then...

php bin/console doctrine:schema:update --force -e dev

# add single static book/author

https://sf3.local/app_dev.php/add

GraphQL Bundles

composer require overblog/graphql-bundle

composer require --dev overblog/graphiql-bundle

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

Example mutation

```
mutation {
  authorAdd(
    name: "Ernest Cline", 
    bio: "Something about Ernest") {
      id, name
    }
}
```


#### nginx config

https://www.nginx.com/resources/wiki/start/topics/recipes/symfony/


#### PHP

PHP 5.6 required

Steps to upgrade to php 5.6 

```
sudo apt-get -y update
sudo add-apt-repository ppa:ondrej/php
sudo apt-get -y update
sudo apt-get -y install php5.6 php5.6-mcrypt php5.6-fpm php5.6-mbstring php5.6-curl php5.6-cli php5.6-mysql php5.6-gd php5.6-intl php5.6-xsl php5.6-zip
php -v
```

then update to nginx config

fastcgi_pass unix:/var/run/php/php5.6-fpm.sock;


### React

/react-graphql

npm run start





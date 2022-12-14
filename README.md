<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About Project

This is a web application where i put some knowledges, here i build a basic store where we can add products, update and delete it and add a module where we can sell these products. Inside the application i worked with POO, Solid, Services, Routes, Models, ORM Eloquent, Database Cache among others.

## Start Project

Before you download project, please run:

```bash
# install vendor packages
$ composer install
```

After configure your .env file according your database enviroment.

For generate the new application key

```bash
# generat new key aplication on the .env file
$ php artisan key:generate
```

Having the .env file you can excetue laravel migrations with:

```bash
# run laravel migation and create the data model
$ php artisan migrate
```

After run the seeders, it work for create an example user and some products categories

```bash
# run seeders for create users and product categories
$ php artisan db:seed
```

After that you can start the application in local with:

```bash
# start the virtual server and run application
$ php artisan serve
```

## Notes

You need to create some products first, after you can view the products in the store and start adding to cart, when you have some products in cart, you can place an order with those products, then you can see the table with latest orders created.
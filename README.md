# BooksApi

## Introduction

This is simple zend-framework based API wrapper.

## TODO:

- clone it to your server
- rename config/autoload/local.php.dist to config/autoload/local.php
- add your database credentials
- update dependencies using composer 

```bash
$ composer update
```
- execute migrations using doctrine-module
```bash
$ ./vendor/bin/doctrine-module migrations:migrate
```
## RUN WITH DOCKER
##### To run application with docker execute next commands:
build image with php 
```bash
$ docker build -t hamlet/php:7.2-fpm
```
set up containers
```bash
$ docker-compose up -d
```
go inside php container and run composer instal and execute a migrations
```bash
$ docker exec -it api_php_1 bash
$ composer install
$ ./vendor/bin/doctrine-module migrations:migrate
```

##### That's it.

## Running Unit Tests
To run the supplied unit tests, you need to write simple console command: 
```bash
$ composer test
```

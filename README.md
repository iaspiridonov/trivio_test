# Test task for the Trivo

## For create database:
```bash
$ sqlite3 data/trivio_db.db < data/schema.sql
(or sqlite data/trivio_db.db < data/schema.sql)
```
## Introduction

This is a skeleton application using the Laminas MVC layer and module
systems. This application is meant to be used as a starting place for those
looking to get their feet wet with Laminas MVC.

## Installation using Composer

The easiest way to create a new Laminas MVC project is to use
[Composer](https://getcomposer.org/). If you don't have it already installed,
then please install as per the [documentation](https://getcomposer.org/doc/00-intro.md).

To create your new Laminas MVC project:

```bash
$ composer create-project -sdev laminas/laminas-mvc-skeleton path/to/install
```

## Using docker-compose

This skeleton provides a `docker-compose.yml` for use with
[docker-compose](https://docs.docker.com/compose/); it
uses the provided `Dockerfile` to build a docker image 
for the `laminas` container created with `docker-compose`.

Build and start the image and container using:

```bash
$ docker-compose up -d --build
```

At this point, you can visit http://localhost:8080 to see the site running.

You can also run commands such as `composer` in the container.  The container 
environment is named "laminas" so you will pass that value to 
`docker-compose run`:

```bash
$ docker-compose run laminas composer install
```
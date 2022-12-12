# Workshop ClassicModels

## What ? Why ?

This tutorial is about how we can build a simple application in PHP containing the following features :
* Display a list of products
* Display a single product
* Register a new user
* Login a user
* Logout a user

More importantly, you will also see in this tutorial some examples of form usage,
proper PDO statements and database transactions in PHP.
It can serve as a point of reference for future exercises and projects.

## Where to start ?

This repository makes use of our usual Docker environment, but with an added bonus : the _classicmodels.sql_ script gets
executed whenever we build our container (see line 10 of the [docker-compose file](docker-compose.yml)). It will seed
our starting database and allow us to start working on the new features right away.

Simply put, just start the containers using the following command :
> docker compose up

And that should do it !
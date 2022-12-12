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

## What are the different steps ? 

This project will happen in multiple steps : 
* First, we will create a basic PHP application with the features mentioned above.
* Then, we will refactor this to OOP.
* Then, we will implement a routing system.
* Finally, we will use the MVC architecture to organize the project.

We currently are at the **first** step.

## Where to start ?

This repository makes use of our usual Docker environment, but with an added bonus : the _classicmodels.sql_ script gets
executed whenever we build our container (see line 10 of the [docker-compose file](docker-compose.yml)). It will seed
our starting database and allow us to start working on the new features right away.

First, you will need to create a .env file (an example is provided with _.env.example_) where you will put your future database credentials.
Be aware that you will need to also update the mysql user in the /scripts/init.sql file, using the same one as the DB_USERNAME of your env file.

Then, just start the containers using the following command :
> docker compose up --build

And that should do it !

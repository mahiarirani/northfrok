# Northfrok Book API

This repository contains the code for the Northfrok API, developed using PHP with Laravel framework.

## Requirements

To run the API, you need to have the following software installed:

-   PHP 7.4 or higher
-   Composer
-   A database management system such as MySQL

## Installation

1.  Clone this repository to your local machine:

`git clone https://github.com/mahiarirani/northfrok.git`


2. Create a copy of the environment file:

```
cd northfrok
cp .env.example .env
```


3. Install the dependencies using Composer:


``` 
composer install
```


4. Edit the `.env` file with your database configuration:

```
DB_CONNECTION=mysql 
DB_HOST=127.0.0.1 
DB_PORT=3306 
DB_DATABASE=northfrok 
DB_USERNAME=root 
DB_PASSWORD=  
```  

5. Create the database:

`php artisan migrate:install`


6. Optionally, you can populate the database with fake data for testing purposes:



`php artisan db:seed`

## Usage

To start the web server, run the following command:



`php artisan serve`

You can specify a different port using the `--port` option:



`php artisan serve --port=8000`

To test the API, run the following command:



`php artisan test`

To use the API, you can import the [Postman Workspace](https://www.postman.com/app-room/workspace/mahyar-s-public-apis/collection/3801578-0b89d34b-b351-41f4-beab-7ad806fcbcb4?action=share&creator=3801578) and set the value of the `url` environment variable to the URL of your local server.

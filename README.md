# Book-e-shelf
Application for listing book reads based on Phalcon, Vue.js and Semantic UI. 

## Requirements
* [PHP 7.1.*](http://php.net/downloads.php)
* [Phalcon extension - version 3.1.2](https://phalconphp.com/en/download/)
* [Composer](https://getcomposer.org/download/)
* [Node.js](https://nodejs.org/en/download/)

## Installation
Installation is simple and quick.
First of all, you need to download all dependencies with Composer. It will require phpdotenv environmental library, Phinx migration library and Carbon datetime library. In next step you are supposed to create `.env` file based on provided `.env.example` file and insert there all data for database connection. After that you can run migrations and install all frontend dependencies.

### Development environment 
```
$ composer update
$ npm run build
$ cp .env.example .env
$ migrate
```
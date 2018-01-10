# MindKraft 2018

Copyright (c) 2017 Z-Coders All Rights Reserved.

****

* **Framework** - Laravel 5.5
* **Database** - MySQL

## Development Environment Setup Instructions

  **Required Packages**

  * NodeJS 8+
  * PHP 7.0+
  * Composer
  * Git

  **Setup Instructions**

  * Install all required packages
  * Run `composer install` to install Laravel and other packages
  * Run `npm install` to install other dependencies
  * Run `cp .env.example .env` to initialize the Laravel Environment
  * Run `php artisan key:generate`
  * Run `php artisan serve` to start developement server

  **Production Build Instructions**

  * In `developement` branch, run `npm run production`
  * Commit the changes with the message `Production build #[number]`
  * Create a pull request from `developement` to `production`
  * Approved code will be merged into `production` by one of the Admins

## Production Environment Setup Instructions

  **Requirements**

    * Nginx server
    * PHP 7.0+
    * MySQL 5.7+
    * Git
    * Composer
    * SSH access to server

  **Setup**

    * Clone the repository
    * Run `composer install`
    * Run `cp .env.example .env`
    * Run `php artisan key:generate`
    * In `.env`
      * Set `APP_ENV` to `production`
      * Set `APP_DEBUG` to `false`
      * Set database variables

  Just run `git pull` to get the latest production ready changes

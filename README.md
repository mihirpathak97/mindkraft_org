# MindKraft 2018

Copyright (c) 2017 Z-Coders All Rights Reserved.

****

* **Framework** - Laravel 5.5
* **Database** - MySQL

## Development Environment Setup Instructions

  **Required packages**

  * NodeJS 8+
  * PHP 7+
  * Composer
  * Git

  **Setup Instructions**

  * Install all required packages
  * Run `composer install` to install Laravel and other packages
  * Run `npm install` to install other dependencies
  * Run `cp .env.example .env` to initialize the Laravel Environment
  * Run `php artisan key:generate`
  * Run `php artisan serve` to start developement server

## Production Build Instructions

  **Setup**

  * In `developement` branch, run `npm run production`
  * Production ready code is then pushed to `production` branch

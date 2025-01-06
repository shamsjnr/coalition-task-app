# Project installation guide Windows (Local machine)

## Prerequisites
* PHP >= 8.2 - [Download PHP](https://www.php.net/downloads.php)
* MySQL server >= 5 [Download MySQL](https://dev.mysql.com/downloads/mysql/)
* * or XAMPP (Comes with PHP and MySQL) [Download XAMPP](https://www.apachefriends.org/download.html)
* Composer - [Download Composer](https://getcomposer.org/download/)
* Node.js - [Download Node](https://nodejs.org/en/download)

## Project Setup
- Extract the downloaded Zip file to "coalition-task-app" (For XAMPP, typically "C:\xampp\htdocs\coalition-task-app")
- Start up MySQL server (For XAMPP, Open XAMPP control panel and click start for the MySQL service)
- Open up Windows Terminal
- Navigate to the extracted folder 
` cd coalition-task-app `
- Install PHP dependencies
` composer install `
- Create Environment variable from sample file
` cp .env.example .env `
- Generate application encryption key
` php artisan key:generate `
- Create required symlinks
` php artisan storage:link `
- Run Database migrations
` php artisan migrate `
- Start the application if everything so far was succcessful
` php artisan serve `

*In case of an error with the project setup, you can always look-up the [laravel installation documentation](https://laravel.com/docs/11.x/installation)*

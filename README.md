## Project installation guide Windows (Local machine)

### Prerequisites
* PHP >= 8.2 - [Download PHP](https://www.php.net/downloads.php)
* MySQL server >= 5 [Download MySQL](https://dev.mysql.com/downloads/mysql/)
  * or XAMPP (Comes with PHP and MySQL) [Download XAMPP](https://www.apachefriends.org/download.html)
* Composer - [Download Composer](https://getcomposer.org/download/)
* Node.js - [Download Node](https://nodejs.org/en/download)

### Project Setup
- Extract the downloaded Zip file to `coalition-task-app` (For XAMPP, typically `C:\xampp\htdocs\coalition-task-app`)
- Start up MySQL server (For XAMPP, Open XAMPP control panel and click start for the MySQL service)
- Open up Windows Terminal
- Navigate to the extracted folder 
    ``` cmd
    cd coalition-task-app
    ```
- Install PHP dependencies
    ``` cmd
    composer install
    ```
- Create environment variables from the sample file
    ``` cmd
    cp .env.example .env
    ```
- Generate application encryption key
    ``` cmd
    php artisan key:generate
    ```
- Create required symlinks
    ``` cmd
    php artisan storage:link
    ```
- Run Database migrations
    ``` cmd
    php artisan migrate
    ```
- Start the application if everything so far has been succcessful
    ``` cmd
    php artisan serve
    ```
*For development, you will be needing the node.js environment:*
- Start the Node.js environment
    ``` cmd
    npm run dev
    ```
- Build assets for production
    ``` cmd
    npm run build
    ```

*In case of an error with the project setup, you can always look-up the [laravel installation documentation](https://laravel.com/docs/11.x/installation)*



<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Invoicing Challenge

Build a UI and API that allow a user to capture invoices as shown in the image below, and store it in a database. 
Requirements are:

- Used plain SQL queries, and not an ORM. .
- Web based solution

<p align="center"><a href="https://cdn.vertex42.com/ExcelTemplates/Images/excel-invoice-template.png" target="_blank"><img src="https://cdn.vertex42.com/ExcelTemplates/Images/excel-invoice-template.png" width="400"></a></p>


## Solution

I have solve the challenge using Laravel PHP framework,Jquery,HTML 5, Boostrap and MYSQL.

## Why did i choose Laravel Framework
- Laravel is a free and open-source PHP-based web framework.
- Laravel uses the model–view–controller (MVC) architectural pattern.
- Automated and Unit Testing Feature
- Scalability,security


## How i have implement RAW SQL queries and no ORM -Eloquent

I have created directory name RawQueries under Models directory then created model class using PDO for each tables.

- Invoices.
- InvoicesItems.
- Customers

## How to install this app

- Clone
- Use .env.sample for your .env
- Setup your database connection in .env
- Run Migration  php artisan migrate
- Run Db Seeder  php artisan db:seed --class=CustomerTableSeeder
- Run php artisan serve
- Navigate to http://127.0.0.1:8000/ on your browser
- Congrats! You now creating an Invoice

## Running test 
To test if the app is running successfully
run php artisan test

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

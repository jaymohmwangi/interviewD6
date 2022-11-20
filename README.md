

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Invoicing Interview Challenge

We’d like you to build a UI and API that allow a user to capture invoices as shown in the image below, and store it in a database. You can assume that your solution is part of a bigger system, so you do not need to implement authentication or additional list/view screens. Keep in mind how invoices would be handled in a real system - some elements would be pre-configured or selectable, rather than being captured from scratch.
You can use any framework and database you like, and you can pre-populate the database however you wish. We will review and test your solution as we would production code, meaning input validation/error handling is important. 

Our only requirements are:

- That you use plain SQL queries, and not an ORM. .
- That your solution be web based

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
 
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

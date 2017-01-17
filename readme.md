# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Project Decription
This project was developed for job seekers and employers spend less time to search, apply or select employee.

## Below are what this project can do for now
1. User registration(either by their own user or by administrator)
2. En email will send to registered user with a link to veryfy their account.
3. Can update their profile
4. All profile photos are resized to 120 X 150
5. All profile photos are named by radom number with 10 digits uniquely.
6. Employers can post/edit/delete/ and disable/enable their jobs.
7. Employees can apply job if their account is activated by sending one email to Employer directly with attachment of their latest CV generation as PDF file with profile photos.
8. For adminstator can manage all users and jobs in the system
10. All profile photos are store in two directory, one for original photo and another for the resized photos.
11. Everytime when profile photos are update, it will remove from both dirdtory as well
11. When users is removed from the system, all their information(CV,job) will be removed authomatically.

## How to install in your local?
1. Please clone this project into your webserver directory (eg:wamp/www)
2. Rename .env-example to .env
3. Create a virtual host is recommended
4. Configure smtp in .env file which you juse renamed
- DB_HOST
- DB_USERNAME
- DB_PASSWORD
- MAIL_DRIVER
- MAIL_HOST
- MAIL_PORT
- MAIL_USERNAME
- MAIL_PASSWORD
- MAIL_ENCRYPTION

## Example : 

APP_ENV=local

APP_DEBUG=true

APP_KEY=base64:6tbZLZ6M4xBwavZvHI+xWzUBZ5tNR1SUbqosjsZHoA8=

APP_URL=http://cambodianjob.local/

DB_CONNECTION=mysql

DB_HOST=localhost

DB_PORT=3306

DB_DATABASE=cambodianjob

DB_USERNAME=root

DB_PASSWORD=

CACHE_DRIVER=file

SESSION_DRIVER=file

QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1

REDIS_PASSWORD=null

REDIS_PORT=6379

MAIL_DRIVER=smtp

MAIL_HOST=smtp.gmail.com

MAIL_PORT=587

MAIL_USERNAME=ariya.hun16@gmail.com

MAIL_PASSWORD=ariya16159753

MAIL_ENCRYPTION=tls

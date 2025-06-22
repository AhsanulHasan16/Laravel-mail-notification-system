# Laravel-mail-notification-system
This is the task for Arabree.

## Technologies Used
- Laravel 12
- MySQL
- Laravel queue and scheduled commands
- Mailtrap

## Features Implemented
Implemented all the requirements. 

### CRUD functionality for the customers
- Validates fields using FormRequest.
- Stored address as JSON.
  
### Admin gets a mail notification on the event of new customer creation
- Used Laravel's built-in mailable system.
- Used Queues so that the mailing doesn't interrupt the rest of the application.
- Used Mailtrap for sending mails.

### Customers from a specific country and postcode are getting good morning emails at a specific time
- Intended to be run daily at 8 AM via Laravel Scheduler.
- Checks all the users having specific country and postcode and uses chunk() while sending mails, so that a memory leak does not occur.

### Database Optimization
- Indexed the country and postcode field of the address JSON using virtual columns.
- This is really necessary when there are as many as 20 lac rows and these fields have to be accessed daily.

## Installation
- Clone the repo then run: 
- composer install
- cp .env.example .env
- php artisan key:generate
- php artisan migrate --seed

Also, don't forget to add your local DB info and mail sending configs in the .env file.

That's all. Thanks.

Author,

Yours Truly,

Md. Ahsanul Hasan.

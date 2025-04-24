# Booking System (Laravel 12)

This is a simple Booking System built with Laravel 12. It helps manage reservations or bookings (you can customize it based on your needs).

## Requirements

Before getting started, make sure you have the following installed:

- PHP 8.2 or higher
- Composer
- Node.js and npm
- MySQL or any other supported DB
- Laravel CLI (`composer global require laravel/installer`)

---

## Project Setup

Follow these steps to get the project running locally.

### 1. Clone the repository

git clone https://github.com/himanshuvaghela1998/customer-booking.git
cd customer-booking

## Install PHP dependencies

composer install

## Copy the .env file and update config

cp .env.example .env

.env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=customer_booking
DB_USERNAME=root
DB_PASSWORD=

Mail

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=e448f6b2303bd0
MAIL_PASSWORD=8b0a9e214d790e
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

## Run the database migrations

php artisan migrate

## Install node modules

npm install

## Build assets

npm run dev

## Start the Laravel server

php artisan serve

## Clear cache

php artisan optimize:clear
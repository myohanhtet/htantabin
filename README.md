# Htantabin Project

![Htantabin Logo](public/images/favicon/mstile-150x150.png)

## Overview

Htantabin is a voucher system for use at the Monasteries. It includes two types of vouchers.

## Features

- Lucky Draw voucher
- Pathan voucher
- User role based
- Print with PDF

## License

## Installation
Clone this repository
```bash
git clone https://github.com/myohanhtet/htantabin.git
```
Change Directory
```bash
cd htantabin
```
Install php dependencies
```bash
composer install 
```
Install js dependencies
```bash
npm install
```
Copy .env.example to .env
```bash
cp .env.example .env
```
Generate Application key
```bash
php artisan key:generate
```
Database Setting
Create a database and update .env file with database credentials
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=htantabin
DB_USERNAME=root
DB_PASSWORD=
```
Run migrations
```bash
php artisan migrate 
```
Run Seeder
```bash
php artisan db:seed
```
## Users
```
Email : superadmin@gmail.com,
Password : 12345678
```
This project is licensed under the [MIT](LICENSE) License

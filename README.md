# ToDos
A simple web app based on Laravel.
## Requirements
Todos has the following requirements:
- PHP
  \>= 7.2
  - For installation and maintenance, you’ll need to be able to run `php` from the command line.
- MySQL
  \>= 5.6
  - Single Database
- Git Version Control
  - (Not strictly required but helps manage updates)
- **[Composer](https://getcomposer.org/)**
## Dependences
- [Dark Mode Switch](https://github.com/coliff/dark-mode-switch)
- [Laravel 7 Acquaintances](https://github.com/multicaret/laravel-acquaintances#check-friend-requests)
## Installation Steps
1. Clone the release branch of the repository into a folder.
2. `cd` into the application folder and run `composer install`.
3. Copy the `.env.example` file to `.env` and fill with your own database details.
4. In the application root, Run `php artisan key:generate` to generate a unique application key.
5. Set the web root on your server to point to the `public` folder. This is done with the `root` setting on Nginx or the `DocumentRoot` setting on Apache.
6. Run `php artisan migrate` to update the database.
7. Done!

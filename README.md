## Installation

Please note this is only tested with PHP 8.1 and follow the mentioned steps to set up the project

1. Run `composer install` to install php packages
2. Run `npm install` to install javascript packages
3. Run `php artisan migrate` to create the tables
4. Run `php artisan ziggy:generate`. This is to use laravel named routes in Vue
5. Please enter the `UNSPLASH_CLIENT_ID` in your `.env` file
6. Finally, run `npm run build` to generate the frontend files


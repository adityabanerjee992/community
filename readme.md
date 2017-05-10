# A Web App To Contribute Articles Using Laravel. 

This is a custom developed web app to contribute articles to your community and also has a voting system to vote on your favourite articles so everyone could see and learn from your contribution. 

### Installation ###

* `https://github.com/adityabanerjee992/community.git projectname`
* `cd projectname`
* `composer install`
* `php artisan key:generate`
* Create a database and inform *.env*
* `php artisan migrate --seed` to create and populate tables
* `php artisan serve` to start the app on http://localhost:8000/

### Features ###

* Home page
* Authentication (registration, login, logout)
* Contribute link with channels
* Vote on the links. 
* Filter links by most recent
* Filter links by most popular
* Filter links by channel


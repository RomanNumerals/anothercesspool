# Another Cesspool
* A forum built on Laravel for the purpose of sharing meaningful and pointless ideas. Hence the title
* Built on the Laravel PHP framework
* Running VueJS

## How to get started with Laravel
* First visit (https://getcomposer.org/download/) and go through the download instructions for composer (also make sure to have
php installed on your machine).
* Next run the following command in your terminal-> composer global require "laravel/installer"
* To fully have it accessible globally on your machine next run-> mv composer.phar /usr/local/bin/composer
* Once it is installed on your machine, navigate to your directory of choice so as to create a new project. To create a new
project run the following command in your terminal-> laravel new name_of_project_goes_here

### Common Commands
* php artisan serve - This allows you to run a localhost server for viewing your project
* php artisan tinker - A REPL that allows you to interact with your project
* php artisan make:auth - Scaffold basic login and registration views and routes
* php artisan make:controller controller_name_here - Create a new controller class
* php artisan make:model model_name_here - Create a new Eloquent model class
* php artisan make:test test_name_here - Create a new test class
* php artisan make:migration table_name_here - Create a new migration file with basic schema for your table
* phpunit - Runs your tests to see if they pass or fail

### Views
* Laravel creates views by using its .blade format. To create an index view you would simply create a new file and save it as
index.blade.php
* Blades allow you to import blocks or layouts from other files as well as pull in page names and sections dynamically

#### Issues, Errors, & Possible solutions
* A few issues that I ran into involved versioning. Laravel 5.5 (which was the tutorial I followed) had different ways of
writing out tests and views/inputs within the app that were different from Laravel 5.7, this caused errors (with awful logs) that 
rendered my project unusable.
* I took the typical route of going onto stack overflow to try and solve my errors, asking for help from my instructor, and even browsing
the Laracasts forum for possible solutions (this was not as fruitful as I would have liked). 
* I rolled back to a point where my project actually worked, but further understanding of Laravel 5.7 & PHP as a whole would help me
to fix my issues. For the minor errors that I encountered there were simple changes that fixed my problems.

#### What went well
* Finding a guide that explained the framework better than the last
* Progress made in a shorter amount of time as opposed to the previous project
* Heroku (sort of) with the exception of the database not connecting properly

#### What could have went better
* Breaking work into smaller chunks, so as to not get overwhelmed with the grand scheme of the project
* Better project breakdown after switching projects
* Better project decision making earlier on to combat the aforementioned issues
* Committing smaller amounts of code to not get lost when trying to trouble shoot

##### Links associated
* Heroku: https://powerful-ravine-97610.herokuapp.com/
* Tutorial: Laracasts.com

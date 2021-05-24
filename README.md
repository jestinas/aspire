#### Local Environment Setup

1. Download and install [Composer](http://getcomposer.org)

	* For Windows:
		* Download and install the package
		* Now run composer from the command line and you should see a list of commands that you have available (this confirms proper installation)
		
	* For Linux:
		* Run the following command from your terminal console: ````curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin````
		* Run: ````php /usr/local/bin/composer.phar````
		* Now run ````composer```` from the command line and you should see a list of commands that you have available (this confirms proper installation)

2. Download [XAMPP](https://www.apachefriends.org/download.html) and get it installed:

#### Clone the Repository

1. Ensure you have the latest version of Git installed. Install from git-scm.com for Windows. For Linux, ````sudo apt-get install git````
2. "*cd htdocs*" under your xampp and then run "*git clone https://github.com/jestinas/aspire.git aspire*" (Alternatively, you may also set it up directly using PhpStorm, follow instructions [here](https://www.jetbrains.com/phpstorm/help/cloning-a-repository-from-github.html))
3. Copy *.env.example* and save as *.env*

#### After Cloning

1. If you've not created a database, create one with the name "*aspire*"
2. change database in env to "*aspire*"
3. keep password null
4. Run ````composer install```` from your terminal
5. In Linux, you might need to run the following commands from your terminal from within the project root folder:
   * _sudo chmod -R 777 bootstrap/cache_
   * _sudo chmod -R 777 storage_
   * _sudo chmod -R 777 vendor_		
6. Run ````php artisan migrate```` from your terminal (*sudo php artisan migrate* for Linux)
7. Run ````php artisan serve```` from your terminal (*sudo php artisan serve* for Linux)
8. Verify everything is working by opening 127.0.0.1:8000(assuming default port) in your browser and create an account


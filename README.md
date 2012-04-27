PHP Online
=============

You can run the PHP code online to quickly test some sample code. And also it helps you to share the code. 

Installation
-----------
* Download the code.
* Place your code in Apache root folder and access public folder. If you want to host under your domain, point to public folder.
* Give write access to the code folder.
* Change the config files for database connections and fb app settings, based on the environment mode set in public/.htaccess
* Thats it. Enjoy :)

Live
----
You can find live app here 
http://dev.riktamtech.com/phponline/public

Troubleshoot
------------
* Check your environment mode in .htaccess file in public folder.
	* SetEnv APPLICATION_ENV "development"
* Open the environment config specific file (app/config/conf_dev.inc.php)
	* Check the database connection
	* Change the facebook app settings
	* Check the php path
* Modify the app/php.ini file
	* you can pull the php.ini from php installation location and add disable_functions property.
* Open config/config.inc.php file
	* Change the file extension if you want 
* DB schema is avaible in db/schema.sql file

Features Planning
-----------------
1. Social Sharing (public, private, etc)
2. Forking code
3. Showing the versions of a file. User can access the old version by changing the number in the URL.
4. Delete the files.
5. Name the files.
6. etc

	
Contributing
------------
1. Fork it.
2. Create a branch (`git checkout -b Php-Online`)
3. Commit your changes (`git commit -am "Added Php-Online"`)
4. Push to the branch (`git push origin Php-Online`)
5. Create an [Issue][1] with a link to your branch

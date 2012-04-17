PHP Online
=============

You can run the PHP code online to quickly test some sample code. And also it helps you to share the code. 

Installation
-----------

* Download the code.
* Point your domain to public folder OR place your code in web root folder.
* Set your environment mode in .htaccess file in public folder
	* SetEnv APPLICATION_ENV "development"
* Give write access to the code folder.
* Open config/config.inc.php file
	* Change the file extension if you want (optional)
* Open the environment config specific file (app/config/conf_dev.inc.php)
	* Set the database connection
* Modify the php.ini file.
	* you can pull the php.ini  from php installation location and add disable_functions property.
* Make sure php can be executable from shell.
* Thats it. Enjoy :)


Features Planning
-----------------

1. Google/Facebook Login
2. Saving the code
3. Sharing (public, private, etc)
4. etc

	
Contributing
------------

1. Fork it.
2. Create a branch (`git checkout -b Php-Online`)
3. Commit your changes (`git commit -am "Added Php-Online"`)
4. Push to the branch (`git push origin Php-Online`)
5. Create an [Issue][1] with a link to your branch

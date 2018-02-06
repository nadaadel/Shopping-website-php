Shopping Website
------------------
is a website to serve user to make shopping online over mobiles phone 

#to run the project 
--------------------
1- first go to your apache server configuration file by run 
$ sudo vim /etc/apache2/sites-enabled/000-default.conf
and paste the content of "virtualHost" and change this path "/home/nada/shopping/web" with your folder is located  file that included in project folder
2- go to hosts file and add the url of the website by run 
$ sudo  vim /etc/hosts
and add =>   127.0.0.1       shopping.com
3- open mysql and run the sql script database "ecommerce.sql" that included in project
4- start apache service by run 
$sudo /etc/init.d/apache2 start
5-go to browser with URL http://shopping.com/home.php and start the shopping 




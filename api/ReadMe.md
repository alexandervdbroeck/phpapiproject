PHP API project

Please create your own root.php and passwd.php in the lib folder, according to the format of the example_passwd.php and example_root.php files.

ROOT: 
1.	make a new file root.php copy the last line of this script and change te folder to your root folder
2.	dont include the root.php in the repo
3.	copy the line in root.php in the lib directory


PASSWD: 
1.	Fill in your data
2.	Create :passwd.php in the Lib Map
3.	Copy the content of this file and put it in the passwd.php file
4.	Make sure you don't put passwd.php on the repo

AUTHENTICATION:

1. in the controller/taak.php and taken.php the user name and pw is temporally Please use them in the basic authentication

API ROUTING:

1. the url for the API call is : phpapi/api/taken  or phpapi/api/taak/4 (task id)
2. the htacces will redirect to controller/..
<?php

//DEFAULT APP CONFIGURATIONS
//Application name
define('APPNAME', 'MtushImports');
//developer
define('DEVELOPER', 'Peter Kimani Mwaura');
//path to root
define('ROOT', 'http://mtushimports1.local');
//path to root
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
//path to root
define('USER_ROOT', 'http://test.local/');
//path to php file
define('APPPATH', ROOT.'app');



//RESC0URCES
//path to Recources
define('IMAGES', ROOT . '/res/images/');




//ADMINISTRATOR USER DATEBASE
//databse host
define("ROOT_DB_HOST", "localhost");
//database username
define("ROOT_DB_USERNAME", "root");
//database password
define("ROOT_DB_PASSWORD", "");
//database name
define("ROOT_DB_NAME", "mtushImportsdb");





//SECURE USER
/*this user is the nomal user to access the SQLiteDatabase
*Data   -SELECT
        -INSERT
        -UPDATE
        *DELETE
        *FILE

*Structure  -NO STRACTURE PERMISIONS

*Administration -NO ADMINISTRATION PERMISONS

*Resource limits  MAX QUERIES PER HOUR      unlimited
                  MAX UPDATES PER HOUR      unlimited
                  MAX CONNECTIONS PER HOUR  unlimited
                  MAX USER_CONNECTIONS      unlimited
*/
define("DB_HOST", "localhost");
//database username
define("DB_USERNAME", "root");
//database password
define("DB_PASSWORD", "");
//database name
define("DB_NAME", "mtushImports");

<?php
session_set_cookie_params(0);
session_start();

// Development credentials
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','11091968');
define('DBNAME','news_m314007');

define('AlertPending', 1);
define('AlertOK', 2);
define('AlertFailed', 3);

$conn = @mysql_connect (DBHOST, DBUSER, DBPASS);
$conn = @mysql_select_db (DBNAME);

if(!$conn)
{
    die( "Error connecting to the database.");
}
mysql_query("SET NAMES UTF8");

define('SITETITLE','phpcms');
?>

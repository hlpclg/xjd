<?php

$db_host   = "localhost:3306";

// database name
$db_name   = "hng";

// database username
$db_user   = "root";

// database password
$db_pass   = "";

// table prefix
$prefix    = "ecs_";

$timezone    = "PRC";

$cookie_path    = "/";

$cookie_domain    = "";

$session = "1440";

define('EC_CHARSET','utf-8');


if(!defined('ADMIN_PATH'));
{
define('ADMIN_PATH','okok');
}

if(!defined('ADMIN_PATH_M'));
{
define('ADMIN_PATH_M','okok');
}
define('AUTH_KEY', 'this is a key');

define('OLD_AUTH_KEY', '');

define('API_TIME', '2016-05-26 20:41:14');

?>
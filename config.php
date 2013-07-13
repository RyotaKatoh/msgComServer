<?php

//should change settings on production environment
define('DB_HOST', 'localhost');
define('DB_USER', 'MessageDBUser');
define('DB_PASSWORD', 'Greo98Mnfg23ge!');
define('DB_NAME', 'messageDB');

define('APP_ID','506894829377608');
define('APP_SECRET','b9ca525dcc69691a58900568172f3fac');

define('SITE_URL', 'http://ec2-54-248-86-228.ap-northeast-1.compute.amazonaws.com/msgCom/fb_connect_php/');

error_reporting(E_ALL & ~E_NOTICE);

session_set_cookie_params(0, '/msgCom/');

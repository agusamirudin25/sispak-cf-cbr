<?php
header('Access-Control-Allow-Origin:*');

session_start();

require './../vendor/autoload.php';

require '../core/bootstrap.php';

new Router();

<?php

define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DB_NAME", "todoapi");


$con = new mysqli(HOST, USER, PASSWORD, DB_NAME);

$con->set_charset("utf8");

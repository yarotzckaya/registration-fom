<?php
require "libs/rb.php";

R::setup( 'mysql:host=localhost;dbname=db',
    'root', '123' ); //for both mysql or mariaDB

session_start();
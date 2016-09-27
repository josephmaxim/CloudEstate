<?php

//  Group #     :
//  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
//  File name   : db.php

// Connect to psql database
function db_connect(){

    $db_connection = pg_connect("host=".DBHOST." dbname=".DBNAME." user=".DBUSER." password=".DBPASS);

    return $db_connection;
}
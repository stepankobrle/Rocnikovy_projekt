<?php

/**
 *
 *
 * This function connects to the database
 *
 * @return $connection
 *
 */

function connectionDatabase()
{
    $db_host = "127.0.0.1";
    $db_users = "stpkbl";
    $db_password = "123456stp";
    $db_name = "myapp1";

    $connection = mysqli_connect($db_host, $db_users, $db_password, $db_name);

    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    }

    return $connection;
}
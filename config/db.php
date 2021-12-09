<?php
ini_set( 'display_errors', 'on' );
error_reporting( E_ALL );
@session_start();
ob_start();
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = 'db-stockFSJ';

$db = mysqli_connect( $servername, $username, $password, $dbname );
if ( !$db ) {
    die( "Connection failed: " . mysqli_connect_error() );
}

?>

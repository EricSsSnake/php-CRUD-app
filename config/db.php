<?php
define('ROOT_URL', "http://localhost/CRUD%20app/");

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '123456');
define('DB_NAME', 'CRUD app');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Error: $conn->connect_error");
}

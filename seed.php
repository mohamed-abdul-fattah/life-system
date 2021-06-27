<?php

require_once __DIR__ . '/helpers.php';

$conn = open_connection();

mysqli_query($conn, "INSERT INTO categories (`name`) VALUES ('Food'), ('Transportation')");

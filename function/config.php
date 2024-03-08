<?php

$host = 'localhost';
$username = 'root';
$password = '';
$db = 'libratech';

session_start();

$koneksi = mysqli_connect($host, $username, $password, $db) or die(mysqli_error($koneksi));
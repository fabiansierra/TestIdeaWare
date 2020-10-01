<?php
  $servername = "localhost";
  $username   = "phpmyadmin";
  $password   = "12345678";
  $dbname     = "testidea";
  
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
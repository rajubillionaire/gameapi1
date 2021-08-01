<?php

error_reporting(0);

$con=mysqli_connect("localhost","root","","gameapi");// Check connection

// Check connection

if (mysqli_connect_errno())

  {

  echo "Failed to connect : " . mysqli_connect_error();

  }



//get full url



$url =  "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$basename = basename($url);

$ip=$_SERVER['REMOTE_ADDR'];

date_default_timezone_set('Asia/Kolkata');

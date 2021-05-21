<?php

$serverName="remotemysql.com:3306.";
$dbUserName="gPTmnJX7J9";
$dbpwd="IoNKzsl5Bb";
$dbBaseName="gPTmnJX7J9";

$dbconn= mysqli_connect($serverName,$dbUserName,$dbpwd,$dbBaseName);

if(!$dbconn){
    die("connection failed " .mysqli_connect_error());
}
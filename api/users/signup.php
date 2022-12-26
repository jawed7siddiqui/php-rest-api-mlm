<?php
include_once("../../config/Headers.php");
include_once("../../config/Database.php");
include_once("../../models/User.php");


// Instantiate DB and Connect to It
$database = new Database();
$db = $database->connect();

// Instantiate user object
$user = new User($db);

// Get raw POSTed data
$data = $_POST;
$user->Xname = $data['Xname'];
$user->Xemail = $data['Xemail'];
$user->Xpassword = $data['Xpassword'];
$user->Xcountry_code = $data['Xcountry_code'];
$user->Xcountry = $data['Xcountry'];
$user->Xmobile = $data['Xmobile'];
$user->Xgender = $data['Xgender'];
$user->Xdob = $data['Xdob'];
$data = $user->create();
echo $data;

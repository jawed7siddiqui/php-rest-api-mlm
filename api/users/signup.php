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
$user->Xname = $data['name'];
$user->Xemail = $data['email'];
$user->Xpassword = $data['password'];
$user->confirm_password = $data['confirm_password'];
$user->step = $data['step'];
$user->Xcountry_code = $data['country_code'];
$user->Xcountry = $data['country'];
$user->Xmobile = $data['mobile'];
$user->Xgender = $data['gender'];
$user->Xdob = $data['dob'];
$data = $user->signup();
echo $data;

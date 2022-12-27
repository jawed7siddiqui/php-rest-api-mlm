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
$user->user_id = $data['user_id'];
$user->Xcountry_code = $data['country_code'];
$user->Xcountry = $data['country'];
$user->Xmobile = $data['mobile'];
$user->Xgender = $data['gender'];
$user->Xdob = $data['dob'];
$user->Xreferral_code = $data['referral_code'];

$data = $user->signup_details();
echo $data;

<?php
// Headers for GET Request
header("Access-Control-Allow-Origin: *");
header("Content-type: multipart/form-data");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods,Content-type,Access-Control-Allow-Origin, Authorization, X-Requested-With");

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
$data = $user->create();
echo $data;

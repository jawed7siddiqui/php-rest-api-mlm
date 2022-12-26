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
$user->id = $data['id'];
$data = $user->UserDetails();
echo $data;

<?php

  include_once ('../config/db.php');
  include_once ('../objects/user.php');
  session_start();

  // get database connection
  $database = new Database();
  $db = $database->getConnection();


  // instantiate user object
  $user = new User($db);
  $user->userid = $_GET['userid'];

  //set product property values
  $query = $user -> read_one();

  if($query){
    http_response_code(200);
    echo json_encode(array(
           "userid" => $user->userid,
           "username" => $user->username
    ));

  } else{
    http_response_code(404);
    echo json_encode(array("message"=> "NOT FOUND"));
  }




 ?>

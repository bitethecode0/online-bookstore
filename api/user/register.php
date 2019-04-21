<?php
  include_once '../config/db.php';
  include_once '../objects/user.php';

  // get database connection
  $database = new Database();
  $db = $database->getConnection();
  //$is = $_POST['username'];

  // instantiate user object
  $user = new User($db);

  // get posted data
  $data = json_decode(file_get_contents("php://input"));

  //set product property values
  $user->username = $data->username;
  // exists? true : false
  $isUserCreated = $user->create();

  if($isUserCreated){
    http_response_code(200);
    echo json_encode(array(
           "userid" => $user->userid,
           "username" => $user->username
    ));
    //echo 'true';
  } else{

    http_response_code(401);
    //echo json_encode(array("message" => "Login failed."));
    echo 'false';
  }


 ?>

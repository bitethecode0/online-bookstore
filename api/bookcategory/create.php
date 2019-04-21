<?php

  include_once '../config/db.php';
  include_once '../objects/bookcategory.php';
  session_start();

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // instantiate user object
  $bookcategory = new Bookcategory($db);

  // get posted data
  $data = json_decode(file_get_contents("php://input"));
  $bookcategory->ISBN = $data->isbn;

  for ($i = 0; $i < count($data->subjects); $i++) {
     $bookcategory->subject = $data->subjects[$i];
     if($bookcategory->create()){
       http_response_code(200);
       
     }else{
           http_response_code(503);
           echo json_encode(array("message" => "Unable to insert."));
     }
  }
?>

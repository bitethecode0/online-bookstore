<?php

  include_once '../config/db.php';
  include_once '../objects/writtenby.php';
  session_start();

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  $writtenby = new Writtenby($db);

  // get posted data
  $data = json_decode(file_get_contents("php://input"));
  $writtenby->isbn = $data->isbn;

  for ($i = 0; $i < count($data->authors); $i++) {
     $writtenby->aid = $data->authors[$i];
     if($writtenby->create()){
       http_response_code(200);
     }else{
           http_response_code(503);
           echo json_encode(array("message" => "Unable to insert."));
     }
  }

 ?>

<?php

  include_once '../config/db.php';
  include_once '../objects/author.php';
  session_start();

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // instantiate user object
  $author = new Author($db);

  // get posted data
  $data = json_decode(file_get_contents("php://input"));

  //set product property values
  $author->authorname = $data->authorname;
  // exists? true : false
  $isAuthorCreated = $author->create();

  if($isAuthorCreated){
    http_response_code(200);
    $query = $author-> read();
    $num = $query -> rowCount();

    if($num>0){
      $arr = array();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $each = array("authorid" => $authorid, "authorname" => $authorname);
        array_push($arr, $each);

      }
      http_response_code(200);
      echo json_encode($arr);
    } else{
      http_response_code(404);
      echo json_encode(array("message"=> "NOT FOUND"));
    }

  } else{
    http_response_code(401);
    echo json_encode(array("message" => "failed to insert author to the system."));
  }
 ?>

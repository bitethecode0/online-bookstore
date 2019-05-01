<?php

  include_once '../config/db.php';
  include_once '../objects/author.php';
  include_once '../objects/writtenby.php';
  session_start();

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // instantiate user object
  $author = new Author($db);
  $writtenby = new Writtenby($db);
  // get posted data
  $data = json_decode(file_get_contents("php://input"), true);

  foreach($data as $key => $value)
  {
    $author->authorid = $value['id'];
    if($author->delete()){
        http_response_code(200);
        // echo json_encode(array("message"=> "SUCCESSFULLY DELETED"));
      }else{
        // http_response_code(503);
        // echo json_encode(array("message"=> "SOMETHING WENT WRONG"));
    }    
  }

  //show new results
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

 ?>

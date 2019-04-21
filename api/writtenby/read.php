<?php

  $isbn = $_GET['isbn'];
  include_once '../config/db.php';
  include_once '../objects/writtenby.php';
  session_start();

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // instantiate user object
  $writtenby = new Writtenby($db);
  $writtenby->isbn = $isbn;

  $query = $writtenby -> read();
  $num = $query -> rowCount();

  if($num>0){
    http_response_code(200);
    $arr = array();
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $each = array(
        "isbn" => $isbn,
        "authorid" => $authorid,
        "authorname" => $authorname);
      array_push($arr, $each);
    }

    echo json_encode($arr);

  } else{
    http_response_code(404);
    echo json_encode(array("message"=> "NOT FOUND"));
  }

?>

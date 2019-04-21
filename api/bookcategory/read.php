<?php

  $isbn = $_GET['isbn'];
  include_once '../config/db.php';
  include_once '../objects/bookcategory.php';
  session_start();

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // instantiate user object
  $bookcategory = new Bookcategory($db);
  $bookcategory->ISBN = $isbn;

  $query = $bookcategory -> read();
  $num = $query -> rowCount();

  if($num>0){
    $arr = array();
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $each = array("subject" => $subject);
      array_push($arr, $each);
    }
    http_response_code(200);
    echo json_encode($arr);

  } else{
    http_response_code(404);
    echo json_encode(array("message"=> "NOT FOUND"));
  }

?>

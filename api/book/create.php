<?php

  include_once '../config/db.php';
  include_once '../objects/book.php';
  session_start();

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // instantiate user object
  $book = new Book($db);

  // get posted data
  $data = json_decode(file_get_contents("php://input"));

  //set product property values
  $book->ISBN = $data->isbn;
  $book->title =$data->title;
  $book->price =$data->price;
  // exists? true : false
  $isBookCreated = $book->create();

  if($isBookCreated){
    http_response_code(200);
    $query = $book-> read();
    $num = $query -> rowCount();

    if($num>0){
      $arr = array();

      while($row = $query->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $each = array("isbn" => $ISBN, "title" => $title, "price" => $price);
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
    echo json_encode(array("message" => "failed to insert book to the system."));
  }
 ?>

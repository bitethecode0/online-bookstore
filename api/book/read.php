<?php
  include_once '../config/db.php';
  include_once '../objects/book.php';


  $database = new Database();
  $db = $database-> getConnection();

  $book = new Book($db);
  $query = $book -> read();
  $num = $query -> rowCount();


  // if($num>0){
  //   echo $num;
  //   $arr = array();
  //   // $arr["record"] = array();
  //
  //   while($row = $query->fetch(PDO::FETCH_ASSOC)){
  //     extract($row);
  //     $each = array("isbn" => $ISBN, "title" => $title, "price" => $price);
  //     array_push($arr, $each);
  //   }
  //
  //   http_response_code(200);
  //   echo json_encode($arr);
  // } else{
  //   http_response_code(404);
  //   echo json_encode(array("message"=> "NOT FOUND"));
  // }


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


?>

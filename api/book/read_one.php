<?php
  // required headers
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  // include database and object files
  include_once '../config/db.php';
  include_once '../objects/book.php';

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // prepare product object
  $book = new Book($db);

  // set ID property of record to read
  $book->ISBN = isset($_GET['isbn']) ? $_GET['isbn'] : die();
  // read the details of product to be edited
  $book->readone();

  if($book->ISBN!=null){
      // create array
      $arr = array(
            "ISBN" => $book->ISBN,
            "title" =>  $book->title,
            "price" => $book->price
      );

      // set response code - 200 OK
      http_response_code(200);
      echo json_encode($arr);
  }else{
      // set response code - 404 Not found
      http_response_code(404);
      echo json_encode(array("message" => "Product does not exist."));
  }
?>

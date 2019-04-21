<?php

  include_once '../config/db.php';
  include_once '../objects/order.php';
  session_start();

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // instantiate user object
  $order = new Order($db);  

  $query = $order -> read_customer();
  $num = $query -> rowCount();

  if($num>0){
    http_response_code(200);
    $arr = array();
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $each = array(
        'userid' => $userid,
        'username' => $username,
        'total_price' => $total_price

      );
      array_push($arr, $each);
    }

    echo json_encode($arr);

  } else{
    http_response_code(404);
    echo json_encode(array("message"=> "NOT FOUND"));
  }


?>

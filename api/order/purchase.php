<?php

include_once '../config/db.php';
include_once '../objects/order.php';
session_start();

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate user object
$order = new Order($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

foreach($data as $each){
  /*  iterate through json array and operate each // author / delete *** ref
  */
  $order->ISBN = $each->id;
  $order->quantity = (int)$each->quantity;
  $order->cid = (int)$each->userid;

  if($order->purchase()){
    echo json_encode(array("code"=> "200",
    "message" => "Order placed", "data"=> $data));
  } else{
    http_response_code(503);
    echo json_encode(array("code"=> "503",
    "message" => "Unable to order."));
  }

}

?>

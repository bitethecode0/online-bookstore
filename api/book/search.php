<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files

include_once '../config/db.php';
include_once '../objects/book.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$book = new Book($db);

// get keywords
$keywords=isset($_GET["keywords"]) ? $_GET["keywords"] : die();

$stmt = $book->search($keywords);
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
    $arr=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);
        $each=array(
            "isbn" => $ISBN,
            "title" => $title
        );
        array_push($arr, $each);
    }

    // set response code - 200 OK
    http_response_code(200);
    echo json_encode($arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => $keywords)
    );
}
?>

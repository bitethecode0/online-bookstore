<?php
  // error_reporting(E_ALL);
  // ini_set('display_errors', 1);
class Order{
  private $conn;
  private $table_name ="Order";

  public $ISBN;
  public $cid;
  public $quantity;

  public function __construct($db){
    $this->conn = $db;
  }


  function read(){
    $dropview = "DROP VIEW IF EXISTS `view_order`";
    $stmt = $this->conn->prepare($dropview);
    if($stmt->execute()){

    } else{
      echo "what is the problem?\n";
      $arr = $stmt->errorInfo();
      echo print_r($arr);
    }

    $createview="CREATE VIEW `view_order`
    AS SELECT b.isbn, b.title, b.price, o.quantity
    FROM Book b JOIN `Order` o
    ON b.ISBN = o.isbn
    WHERE o.cid = '$this->cid'";

    $stmt = $this->conn->prepare($createview);
    if($stmt->execute()){
      $sql = "SELECT isbn, title, price, quantity, SUM(price*quantity) as total_price FROM `view_order`
              GROUP BY isbn";
      $query = $this->conn->prepare($sql);
      $query ->execute();
      return $query;
    } else{
      echo "what is the problem?\n";
      $arr = $stmt->errorInfo();
      echo print_r($arr);

    }


  }

  function purchase(){

    $sql="CREATE TABLE IF NOT EXISTS `Order`(
      cid  INT(6) UNSIGNED NOT NULL,
      isbn VARCHAR(30) NOT NULL,
      quantity INT(6) NOT NULL,
      FOREIGN KEY(cid) REFERENCES User(userid) ON DELETE CASCADE,
      FOREIGN KEY(isbn) REFERENCES Book(ISBN) ON DELETE CASCADE,
      PRIMARY KEY (cid,isbn)
    )";
    $stmt = $this->conn->prepare( $sql );
    $stmt->execute();

    $sql = "INSERT INTO `Order` VALUES('$this->cid', '$this->ISBN', '$this->quantity')";
    $stmt = $this->conn->prepare($sql);
    if($stmt->execute())
      return true;
    else {
        $arr = $stmt->errorInfo();
        echo "sql : ". $sql.",";
        // echo "user id : ".$this->cid.",";
        echo print_r($arr);
        return false;
    }



  }


}

?>

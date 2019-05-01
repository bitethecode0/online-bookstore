<?php

class Author{
  private $conn;
  private $table_name ="Author";

  public $authorid;
  public $authorname;

  public function __construct($db){
    $this->conn = $db;
  }

  // create new author
  function create(){
    $sql="CREATE TABLE IF NOT EXISTS Author(
      authorid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      authorname VARCHAR(30) NOT NULL
    )";

    $stmt = $this->conn->prepare( $sql );
    $stmt->execute();

    $this->authorname=htmlspecialchars(strip_tags($this->authorname));

    $query = "INSERT INTO Author(authorname) VALUES('$this->authorname')";
    $stmt = $this->conn->prepare($query);
    if($stmt->execute()){
          return true;
    } else{
        echo "what is the problem?\n";
        return false;
    }
  }

  // read authors
  function read(){
    $sql = "SELECT * FROM Author";
    $query = $this->conn->prepare($sql);
    $query ->execute();
    return $query;
  }

  function readone(){
    // query to read single record
    //echo $this->name;
    $query = "SELECT authorid, authorname FROM Author WHERE authorid='".$this->authorid."'";

    // prepare query statement
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    $this->authorid = $row['authorid'];
    $this->authorname = $row['authorname'];
  }

  function delete(){

    $query = "DELETE FROM Author WHERE authorid = '$this->authorid'";
    $stmt = $this->conn->prepare($query);
    if($stmt->execute()){
          return true;
    } else{
        echo "what is the problem?\n";
        return false;
    }
  }
}


?>

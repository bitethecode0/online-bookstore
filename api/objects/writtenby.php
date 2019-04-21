<?php

class Writtenby{

  private $conn;
  // object properties
  public $isbn;
  public $aid;
  // constructor
  public function __construct($db){
      $this->conn = $db;
  }

  function create(){
    $sql="CREATE TABLE IF NOT EXISTS Writtenby(
      isbn VARCHAR(30) NOT NULL,
      aid INT(6) UNSIGNED NOT NULL,
      FOREIGN KEY(isbn) REFERENCES Book(ISBN) ON DELETE CASCADE,
      FOREIGN KEY(aid) REFERENCES Author(authorid) ON DELETE CASCADE,
      PRIMARY KEY (isbn,aid)
    )";

    $stmt = $this->conn->prepare($sql);
    if($stmt->execute()){
      $query = "INSERT INTO Writtenby(`ISBN`, `aid`) VALUES('$this->isbn', '$this->aid')";
      $stmt = $this->conn->prepare($query);
      if($stmt->execute()){
            return true;
      } else{
          echo "what is the problem?\n";
          return false;
      }
    } else{
        echo "what is the problem?\n";
        return false;
    }

  }

  function read(){
    $dropview = "DROP VIEW IF EXISTS `view_author`";
    $stmt = $this->conn->prepare($dropview);
    if($stmt->execute()){

    } else{
      echo "what is the problem?\n";
      $arr = $stmt->errorInfo();
      echo print_r($arr);
    }

    $createview="CREATE VIEW `view_author`
    AS SELECT w.isbn, a.authorid, a.authorname
    FROM Writtenby w JOIN Author a
    ON w.aid = a.authorid
    WHERE w.isbn = '$this->isbn'";

    $stmt = $this->conn->prepare($createview);
    if($stmt->execute()){
      $sql = "SELECT isbn, authorid,authorname FROM `view_author`";
      $query = $this->conn->prepare($sql);
      $query ->execute();
      return $query;
    } else{
      echo "what is the problem?\n";
      $arr = $stmt->errorInfo();
      echo print_r($arr);

    }


  }


  function read_books(){
    $dropview = "DROP VIEW IF EXISTS `view_book`";
    $stmt = $this->conn->prepare($dropview);
    if($stmt->execute()){

    } else{
      echo "what is the problem?\n";
      $arr = $stmt->errorInfo();
      echo print_r($arr);
    }

    $createview="CREATE VIEW `view_book`
    AS SELECT b.ISBN, b.title
    FROM Book b JOIN Writtenby w
    ON b.ISBN = w.isbn
    WHERE w.aid = '$this->aid'";

    $stmt = $this->conn->prepare($createview);
    if($stmt->execute()){
      $sql = "SELECT `ISBN`, title FROM `view_book`";
      $query = $this->conn->prepare($sql);
      $query ->execute();
      return $query;
    } else{
      echo "what is the problem?\n";
      $arr = $stmt->errorInfo();
      echo print_r($arr);

    }


  }

}



?>

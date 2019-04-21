<?php

class Bookcategory{
  private $conn;
  private $table_name ="Bookcategory";

  public $key1;
  public $ISBN;
  public $subject;

  public function __construct($db){
    $this->conn = $db;
  }

  function create(){
    // CREATE TABLE 'Bookcategory'
    $sql ="CREATE TABLE IF NOT EXISTS Bookcategory(
      key1 INT(6) AUTO_INCREMENT PRIMARY KEY,
      ISBN VARCHAR(30) NOT NULL,
      subject VARCHAR(30) NOT NULL,
      FOREIGN KEY(ISBN) REFERENCES Book(ISBN) ON DELETE CASCADE
    )";

    $stmt = $this->conn->prepare($sql);
    if($stmt->execute()){
      $this->ISBN=htmlspecialchars(strip_tags($this->ISBN));
      $this->subject=htmlspecialchars(strip_tags($this->subject));

      $query = "INSERT INTO Bookcategory(ISBN, `subject`) VALUES('$this->ISBN', '$this->subject')";
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
    $sql = "SELECT subject FROM Bookcategory WHERE ISBN='".$this->ISBN."'";
    $query = $this->conn->prepare($sql);
    $query ->execute();

    return $query;
  }

}

?>

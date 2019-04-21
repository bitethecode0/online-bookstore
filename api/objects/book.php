<?php
  // error_reporting(E_ALL);
  // ini_set('display_errors', 1);
class Book{
  private $conn;
  private $table_name ="Book";

  public $ISBN;
  public $title;
  public $price;

  public function __construct($db){
    $this->conn = $db;
  }

  function create(){

    // CREATE TABLE 'BOOK'
    $sql ="CREATE TABLE IF NOT EXISTS Book(
      ISBN VARCHAR(10) PRIMARY KEY,
      title VARCHAR(30) NOT NULL,
      price DECIMAL (3,1) NOT NULL
    )";
    $stmt = $this->conn->prepare($sql);
    if($stmt->execute()){
      $this->ISBN=htmlspecialchars(strip_tags($this->ISBN));
      $this->title=htmlspecialchars(strip_tags($this->title));
      $this->price=htmlspecialchars(strip_tags($this->price));

      $query = "INSERT INTO Book VALUES('$this->ISBN', '$this->title', '$this->price')";
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
    $sql = "SELECT ISBN, title, price FROM Book";
    $query = $this->conn->prepare($sql);
    $query ->execute();

    return $query;
  }

  function readone(){
    // query to read single record
    //echo $this->name;
    $query = "SELECT ISBN, title, price FROM Book WHERE ISBN='".$this->ISBN."'";

    // prepare query statement
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    $this->ISBN = $row['ISBN'];
    $this->title = $row['title'];
    $this->price = $row['price'];

  }

  function search($keywords){
    $keywords = explode(" ", $keywords);
    $condition = "SELECT authorid FROM Author WHERE authorname like  '%".$keywords[0]."%'";
    $condition2 = "SELECT ISBN FROM Bookcategory WHERE subject like  '%".$keywords[0]."%'";

    for($i = 1; $i < count($keywords); $i++) {
      if(!empty($keywords[$i])) {
        $condition.= " OR authorname like '%". $keywords[$i]."%'";
        $condition2.= " OR subject like '%". $keywords[$i]."%'";

      }
    }

    $sql="SELECT DISTINCT b.ISBN, b.title
    FROM Book b
    INNER JOIN Bookcategory bc ON b.ISBN = bc.ISBN
    WHERE bc.ISBN IN ($condition2) UNION
    SELECT DISTINCT b.ISBN, b.title
    FROM Book b
    INNER JOIN Writtenby w ON b.ISBN = w.isbn
    INNER JOIN Author a ON w.aid = a.authorid
    WHERE a.authorid IN ($condition)";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    return $stmt;
  }




}

?>

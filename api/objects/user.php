<?php
// 'user' object
class User{
    // database connection and table name
    private $conn;
    // object properties
    public $userid;
    public $username;
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    // create() method will be here
    function create(){
      // create user table if it is not created yet
      $sql ="CREATE TABLE IF NOT EXISTS `user`(
        userid INT(6) UNSIGNED AUTO_INCREMENT,
        username VARCHAR(30) NOT NULL,
        PRIMARY KEY (userid)
      )";

      $stmt = $this->conn->prepare( $sql );
      $stmt->execute();

      $this->username=htmlspecialchars(strip_tags($this->username));

      $query = "INSERT INTO `user`(username) VALUES('$this->username')";
      $stmt = $this->conn->prepare($query);
      if($stmt->execute()){
            return true;
      } else{
          echo "what is the problem?\n";
          return false;
      }
    }

    // check if given email exist in the database
    function userExists(){
      // query to check if email exists
      $this->username=htmlspecialchars(strip_tags($this->username));

      //.$this->username.
      $sql = "SELECT userid, username FROM User WHERE username = '$this->username'";
      $stmt = $this->conn->prepare( $sql );

      $stmt->execute();

      $num = $stmt->rowCount();
      if($num>0){
          // get record details / values
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          // assign values to object properties
          $this->userid = $row['userid'];
          $this->username = $row['username'];
          return true;
      }

      return false;
    }

    function userExistsWithId(){
      // query to check if email exists


      //.$this->username.
      $sql = "SELECT userid, username FROM User WHERE userid = '$this->userid'";
      $stmt = $this->conn->prepare( $sql );

      $stmt->execute();

      $num = $stmt->rowCount();
      if($num>0){
          // get record details / values
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          // assign values to object properties
          $this->userid = $row['userid'];
          $this->username = $row['username'];
          return true;
      }

      return false;
    }

    /*
      grab users information
    */
    function read(){
      $sql = "SELECT * FROM `user`";
      $query = $this->conn->prepare($sql);
      $query ->execute();
      return $query;
    }

    function read_one(){
      $this->userid=htmlspecialchars(strip_tags($this->userid));

      //.$this->username.
      $sql = "SELECT userid, username FROM User WHERE userid = '$this->userid'";
      $stmt = $this->conn->prepare($sql);

      $stmt->execute();

      $num = $stmt->rowCount();
      if($num>0){
          // get record details / values
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          // assign values to object properties
          $this->userid = $row['userid'];
          $this->username = $row['username'];
          return true;
      }

      return false;
    }


}

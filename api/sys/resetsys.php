<?php
  include("config.php");

  $sql= "DROP TABLE Writtenby;";
  $sql.= "DROP TABLE Author;";
  $sql.= "DROP TABLE Bookcategory;";
  $sql.= "DROP TABLE Book;";
  $sql.= "DROP TABLE User;";


  if(mysqli_multi_query($db, $sql)){
    echo "system is reset!";

  } else{
    echo "Error" .$db->error;
  }

?>

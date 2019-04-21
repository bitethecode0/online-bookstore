<?php
  include("api/config/config.php");

  $sql= "DELETE FROM Writtenby;";
  $sql.= "DELETE FROM Author;";
  $sql.= "DELETE FROM Bookcategory;";
  $sql.= "DELETE FROM Book;";
  $sql.= "DELETE FROM User;";
  $sql.= "DELETE FROM Order;";


  if(mysqli_multi_query($db, $sql)){
    echo "system is reset!";

  } else{
    echo "Error" .$db->error;
  }

?>

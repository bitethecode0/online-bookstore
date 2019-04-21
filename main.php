<?php
  include_once 'api/config/config.php';
  include_once 'api/config/session.php';

  $username = htmlspecialchars($_SESSION['login_user']);
  $sql ="SELECT userid FROM user WHERE username ='$username'";

  if(mysqli_query($db, $sql)){
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_row($result);
    if(!$row){
      "error";
    } else{
      $cid = $row[0];
    }

  } else{
    echo "error while reading user id, ".$username. ", cid ? : ".$cid;
  }
?>
<html>
   <head>
      <title>main</title>
      <link rel ="stylesheet" href="css/style_main.css">
   </head>
   <body>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>

      <script>
        $(document).ready(function(){
          $('#getSearch').click(function(){
            // search

            $.ajax({
              type: 'GET',
              contentType: "application/json",
              url: 'api/book/search.php',
              data : {
                keywords : $('#searchInput').val()
              }

            }).done(function(response){
              alert("working?");
              //alert(response);
              var tr = '';
              tr += '<tr><th></th>';
              tr += '<th>'+"title"+'</th>';
              tr += '<th>'+"quantity"+'</th></tr>';


              $.each(response, function(index) {
                alert(response[index].isbn);

                tr += "<tr><td><input type='checkbox' id='mycheckbox' value='"+(response[index].isbn)+"'></td>";
                tr += '<td><a href=bookDetails.php?isbn='+(response[index].isbn)+'>'+response[index].title+'</a></td>';
                tr += '<td><input type="text" name = "quantity"></td>';

                tr+= '</tr>';
             });

             $('#bookTable').html(tr);

            }).fail(function(){
              alert("fail to search");
            });

            return false;

          });


          /*
            purchase books
          */
          // $('#getOrder').click(function(){
          //
          //   //alert("click working?");
          //   var id = [];
          //   $("#mycheckbox:checked").each(function() {
          //     id.push({
          //       id : $(this).val()
          //     });
          //
          //   });
          //
          //   $.ajax({
          //     type: 'POST',
          //     contentType: "application/json",
          //     url: 'api/book/purchase.php',
          //     data : JSON.stringify({
          //
          //     })
          //
          //
          //   }).done(function(response){
          //     alert("working?");
          //
          //
          //   }).fail(function(){
          //     alert("fail to search");
          //   });
          //   return false;
          // });
          $('#getOrder').click(function(){

            alert("click working?");
            var orders = [];
            $("#mycheckbox:checked").each(function() {
              //var row = $(this).closest("tr")[0].cells[2].find("input").val();
              var row= $(this).closest("tr").find("td").eq(2).find("input").val();
              orders.push({
                id : $(this).val(),
                quantity :row,
                userid : <?php echo $cid ?>

              })
            });

            $.ajax({
              type: 'POST',
              contentType: "application/json",
              url: 'api/order/purchase.php',
              data : JSON.stringify(
                orders
              )
            }).done(function(response){
              alert("working?");
              alert(response);
            }).fail(function(){
              alert("fail to order");
            });


            return false;
          });






        });


      </script>
      <h2>Welcome <?php echo $login_session; ?>
      <p align="right"><a href = "myaccount.php">My Account</a>
                       <a href = "login.php" style ="margin-left :10px;">Sign Out</a></h2></p>
      <form id = "searchForm">
        <input type="text" id="searchInput" class="form-control"/>
        <input type="submit" id ="getSearch" value ="SEARCH">
      </form>


      <div class="table-responsive">
        <form id = "orderForm">
          <table id= "bookTable" border='1' width='250px'>

          </table>
          <input type="submit" id="getOrder" value ="ORDER">
        </form>

      <div/>
   </body>
</html>

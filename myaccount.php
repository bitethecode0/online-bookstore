<?php
  include('api/config/config.php');
  include('api/config/session.php');
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
    echo "error, ".$db->error;
  }
?>

<html>
<head>
  <title>book details</title>
  <link rel ="stylesheet" href = "css/table.css">

</head>
<body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
  <div class="table-responsive">

    <p id = "user_info"></p>
    <table id ="authorDetails" border='1' width='250px'>
      <tr>
        <th>title</th>
        <th>qunatity</th>
        <th>price</th>
      </tr>
    </table>

  </div>
  <label> total price : </lable>
  <label id ="total_price">

  </label>

  <script>
  $(document).ready(function(){
    var id = "<?php echo $cid; ?>";


    $.ajax({
      type: 'GET',
      url: 'api/user/read_one.php',
      data : {
        'userid' : id
      }
    }).done(function(response){
      //alert(response);

      $('#user_info').html(response);
    }).fail(function(){
      alert("fail to read user info");
    });


    var work2 = $.ajax({
      type: 'GET',
      url: 'api/order/read.php',
      dataType: 'json',
      data : {
        'cid' : id
      }
    }).done(function(data){

      var tr ='';
      var total_price =0.0;
      $.each(data, function(i,item){
        tr += '<tr><td>'+(item.title)+'</td><td>'+(item.quantity)+'</td><td>'+(item.price)+'</td></tr>';
        total_price += parseFloat(item.price)* item.quantity;
      });
      // tr += '<tr><td>'+(data[0].title)+'</td><td>'+(data[0].quantity)+'</td><td>'+(data[0].price)+'</td></tr>';
      $('#authorDetails').append(tr);
      $('#total_price').html(total_price.toFixed(2));

    }).fail(function(){
      alert("fail");
    });

  });




    // $.when(work1,work2).done(function(response1,response2){
    //
    //     alert(response1);
    //     alert(response2);
    //     //alert(response2[0].isbn);
    //     data = $.parseJSON(response2);
    //     alert("response ? : "+data);
    //     // $.each(data, function(key, val) {
    //     //         // index is your 0-based array index
    //     //         // el is your value
    //     //
    //     //         // for example
    //     //         //if(index ==0){
    //     //         alert("element at " + key + ": " + val);
    //     //         // $.each(el, function(i,e){
    //     //         //   alert("element in el? :"+e);
    //     //         // });
    //     //
    //     //         // will alert each value
    //     //         //}
    //     //
    //     // });
    //
    //     // var data2 = $.parseJSON(response2);
    //     // alert(data2);
    //     // if(response1 ==null){
    //     //   alert("no response..");
    //     // } else{
    //     //   var data = $.parseJSON(response1);
    //     //
    //     //   alert("user id : "+data.userid);
    //     //   alert("username : "+data.username);
    //     // }
    //
    //
    //
    //     // if(response2== null){
    //     //   alert("no response..");
    //     // } else{
    //     //   var data = $.parseJSON(response2);
    //     //   alert("response 2 : "+data);
    //     //   // $.each(data, function(i, item){
    //     //   //   alert(item.isbn);
    //     //   //   alert(item.title);
    //     // }
    //
    //
    //   });
    //
    //
    // });

  </script>
</body>
</html>

<?php
  $authorid = $_GET['authorid'];
?>

<html>
<head>
  <title>book details</title>

</head>
<body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
  <div class="table-responsive">

    <table id ="authorDetails" border='1' width='250px'>
      <tr>
        <th>author id</th>
        <th>author name</th>
        <th>books</th>
      </tr>
    </table>

  </div>

  <div id ="content"></div>

  <script>
  $(document).ready(function(){
    var id = "<?php echo $authorid; ?>";

    var work1 = $.ajax({
      type: 'GET',
      url: 'api/author/read_one.php',
      data : {
        'authorid' : id
      }
    });

    var work2 = $.ajax({
      type: 'GET',
      url: 'api/writtenby/read_books.php',
      data : {
        'aid' : id
      }
    });

    $.when(work1, work2).then(function(response1, response2){

      var tr = '';
      if(response1 ==null){

      } else{
        alert("response1 : "+response1[0]);
        tr = '<tr><td>'+response1[0].authorid+'</td>';
        tr += '<td>'+response1[0].authorname+'</td>';

      }

      if(response2 == null){

      } else{
        var data2 = $.parseJSON(response2[0]);
        var booksRow ='';

        $.each(data2, function(i, item) {

          booksRow+= '<a href=bookDetailsPage.php?isbn='+item.isbn+'>'+item.title+'</a>';
          if(i<data2.length-1){
            booksRow+=",";
          }
        });

        tr += '<td>'+booksRow+'</td>';

      }

      $('#authorDetails').append(tr);
      console.log(tr);


    });
    return false;

  });
  </script>
</body>
</html>

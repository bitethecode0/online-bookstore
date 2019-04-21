<?php
$isbn = $_GET['isbn'];
?>
<html>
<head>
  <title>book details</title>
  <link rel ="stylesheet" href="css/style_main.css">
</head>
<body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
  <div class="table-responsive">

    <table id ="bookDetails" border='1' width='250px'>
      <tr>
        <th>ISBN</th>
        <th>title</th>
        <th>price</th>
        <th>subjects</th>
        <th>author</th>
      </tr>
    </table>

  </div>

  <div id ="content"></div>

  <script>
  $(document).ready(function(){
    var id = "<?php echo $isbn; ?>";

    var work1 = $.ajax({
      type: 'GET',
      url: 'api/book/read_one.php',
      data : {
        'isbn' : id
      }
    });

    var work2 = $.ajax({
      type: 'GET',
      url: 'api/bookcategory/read.php',
      data : {
        'isbn' : id
      }
    });

    var work3 = $.ajax({
      type: 'GET',
      url: 'api/writtenby/read.php',
      data : {
        'isbn' : id
      }
    });

    $.when(work1, work2, work3).then(function(response1, response2, response3){

      var tr = '';
      if(response1 ==null){

      } else{
        alert("response1 : "+response1[0].ISBN);
        tr = '<tr><td>'+response1[0].ISBN+'</td>';
        tr += '<td>'+response1[0].title+'</td>';
        tr += '<td>'+response1[0].price+'</td>';

      }

      if(response2 == null){

      } else{
        var data2 = $.parseJSON(response2[0]);
        var subjectRow ='';
        $.each(data2, function(i, item) {
            subjectRow+= item.subject;

          if(data2.length !=1){
            if(i<data2.length-1){
              subjectRow+=",";
            }
          }
        });

        tr += '<td>'+subjectRow+'</td>';

      }


      if(response3== null){
        //console.log("null");

      } else{

        var data3 =$.parseJSON(response3[0])
        var authorRow ='';
        $.each(data3, function(i, item) {

          authorRow+= '<a href=authorDetails.php?authorid='+parseInt(item.authorid)+'>'+item.authorname+'</a>';
          if(i<data3.length-1){
            authorRow+=",";
          }
        });

        tr += '<td>'+authorRow+'</td></tr>';
      }

      $('#bookDetails').append(tr);
      console.log(tr);


    });
    return false;

  });
  </script>
</body>
</html>

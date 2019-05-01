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

    <table id ="book" border='1' width='250px'>
      <tr>
        <th>ISBN</th>
        <th>title</th>
        <th>price</th>
      </tr>
    </table>
    <table id ="subject" border='1' width='250px'>
      <th>subjects</th>
    </table>

    <table id ="author" border='1' width='250px'>
      <th>author</th>
    </table>

  </div>

  <div id ="content"></div>

  <script>
  $(document).ready(function(){
    var id = "<?php echo $isbn; ?>";

    $.ajax({
      type: 'GET',
      url: 'api/book/read_one.php',
      data : {
        'isbn' : id
      }
    }).done(function(response){
      tr = '';
      tr = '<tr><td>'+response.ISBN+'</td>';
      tr += '<td>'+response.title+'</td>';
      tr += '<td>'+response.price+'</td>';

      $('#book').append(tr);

    }).fail(function(){
      alert("fail");
    });

    $.ajax({
      type: 'GET',
      url: 'api/bookcategory/read.php',
      data : {
        'isbn' : id
      }
    }).done(function(response){
      var data = $.parseJSON(response);
      var subjectRow ='';
      $.each(data, function(i, item) {
        subjectRow+= item.subject;

        if(data.length !=1){
          if(i<data.length-1){
            subjectRow+=",";
          }
        }
      });

      $('#subject').append(subjectRow);
    }).fail(function(){
      alert("fail");
    });

    $.ajax({
      type: 'GET',
      url: 'api/writtenby/read.php',
      data : {
        'isbn' : id
      }
    }).done(function(response){
      if(response != null ){
        var data =$.parseJSON(response);
        var authorRow ='';
        $.each(data, function(i, item) {
          authorRow+= '<a href=authorDetails.php?authorid='+parseInt(item.authorid)+'>'+item.authorname+'</a>';
          if(i<data.length-1){
            authorRow+=",";
          }
        });
        $('#author').append(authorRow);
      }
      
    }).fail(function(){
    alert("fail");
    });
    //
    // $.when(work1, work2, work3).then(function(response1, response2, response3){
    //   alert(response1);
    //   alert(response2);
    //   alert(response3);
    //
    //   var tr = '';
    //   if(response1 ==null){
    //
    //   } else{
    //     alert("response1 : "+response1[0].ISBN);
    //
    //
    //   }
    //
    //   if(response2 == null){
    //
    //   } else{
    //     var data2 = $.parseJSON(response2[0]);
    //     var subjectRow ='';
    //     $.each(data2, function(i, item) {
    //         subjectRow+= item.subject;
    //
    //       if(data2.length !=1){
    //         if(i<data2.length-1){
    //           subjectRow+=",";
    //         }
    //       }
    //     });
    //
    //     tr += '<td>'+subjectRow+'</td>';
    //
    //   }
    //
    //
    //   if(response3== null){
    //     //console.log("null");
    //     tr += '<td></td></tr>';
    //   } else{
    //
    //     var data3 =$.parseJSON(response3[0])
    //     var authorRow ='';
    //     $.each(data3, function(i, item) {
    //
    //       authorRow+= '<a href=authorDetails.php?authorid='+parseInt(item.authorid)+'>'+item.authorname+'</a>';
    //       if(i<data3.length-1){
    //         authorRow+=",";
    //       }
    //     });
    //
    //     tr += '<td>'+authorRow+'</td></tr>';
    //   }
    //
    //   $('#bookDetails').append(tr);
    //   console.log(tr);
    //
    //
    // });
    return false;

  });
  </script>
</body>
</html>

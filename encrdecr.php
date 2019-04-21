
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title></title>
    <style>
      body{
        align-content:center;
      }
    </style>
  </head>
  <body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>

    <script>
      $(document).ready(function(){

        // $('#getKey').click(function(){
        //   // search
        //
        //   $.ajax({
        //     type: 'GET',
        //     url: 'pub_pri_keys2.php'
        //
        //   }).done(function(response){
        //     alert("working?");
        //     $('#pub_key').html(response);
        //
        //
        //   }).fail(function(){
        //     alert("fail to search");
        //   });
        //
        //   return false;
        //
        // });

        $('#showCipherText').click(function(){
          // search

          $.ajax({
            type: 'GET',
            url: 'key.php',
            data :{
              'action' : 'encrypt',
              'password' : $('#pwd').val()
            }
          }).done(function(response){
            $('#cipherText').val(response.replace(/\"/g, ""));


          }).fail(function(){
            alert("fail to search");
          });

          return false;

        });
        //
        $('#displayCode').click(function(){
          // search

          $.ajax({
            type: 'GET',
            url: 'key.php',
            data :{
              'action' : 'decrypt',
              'cipherText' : $('#cipherText').val()
            }
          }).done(function(response){
            alert(response);


          }).fail(function(){
            alert("fail.");
          });

          return false;

        });


      });




    </script>
    <div align="center">
      <h1><strong>SECURITY</strong></h1>

      <!-- <form>
        <input type ="submit" id = "getKey" value ="RETRIEVE PUBLIC KEY"><br/><br/>
        <br/><br/>
      </form> -->
      <!-- populate public key here -->
      <!-- <p id="pub_key"></p> -->

      <form>
        <lable> ENTER THE PASSWORD <label> <br/><br/>
        <input type ="text" id ="pwd" >
        <input type ="submit" id ="showCipherText" value ="SHOW CIPHER TEXT">
        <br/><br/>

      </form>

      <input type = "text" id = "cipherText">
      <br/><br/>
      <input type = "submit" id="displayCode" value = "DISPLAY CODE">




  </div>
  </body>


</html>

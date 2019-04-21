<html>
  <head>
    <title>Register Page</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>

  <body>
    <body bgcolor = "#FFFFFF">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
      <script>
        $(document).ready(function(){

          $('#registerForm').on('submit', function(){
            $.ajax({
                 type: 'POST',
                 contentType: "application/json",
                 url: 'api/user/register.php',
                 data : JSON.stringify({
                   username : $('#username').val()
                 })
             }).done(function(data){
                 if(data){
                   // login success
                   alert("created.");
                   location.replace("login.php");
                 }

             }).fail(function() {
                 alert( "register failed.");
             });
             // to prevent refreshing the whole page page
             return false;

          });
        });

      </script>
       <div align = "center">
          <div style = "width:350px; border: solid 1px #333333; " align = "left">
             <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Create a new account</b></div>
             <div style = "margin:30px">
                <form id="registerForm">
                   <label>UserName  :</label><input type = "text" id = "username" class = "box"/><br /><br />
                   <label>Password  :</label><input type = "password" id = "password" class = "box" />
                   <input type = "submit" value = "SIGN UP"/><br />
                </form>
             </div>
          </div>
       </div>
    </body>
  </body>
</html>

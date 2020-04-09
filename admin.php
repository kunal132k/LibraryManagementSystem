<?php

// print_r($_POST);
  $error="";
   include("data.php");
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $myusername = mysqli_real_escape_string($link,$_POST['username']);
      $mypassword = mysqli_real_escape_string($link,$_POST['password']); 
      
      $query = "SELECT * FROM `admin_login_details` WHERE username = '$myusername' ";
      $result = mysqli_query($link, $query);
      $row = mysqli_fetch_array($result);
      if (isset($row)) {
        
        if ($mypassword == $row['password']) {
            

            header("Location: adminloggedinpage.php");
                
        } else {
            
            $error = "That username/password combination could not be found.";
            
        }
        
    } else {
        
        $error = "That username/password combination could not be found.";
        
    }
   } 
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="styles/admin_login.css">
    <title>Admin Login</title>
    
  </head>
  <body> 
      <div>
          <a href="home.php"><img src="home_button.png" alt="img" style="width:150px;height:60px;"></a>        
      </div>       
      <div id="error"><?php echo $error; ?></div>
        <div class="container">
            <img src="adlogo2.png" alt="Avatar" style="width:300px;height:200px;"> <br> <br> <br>
            <form method="post" id="loginform">
                <div class="form-group">
                  <input type="username" name="username" class="form-control" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div> <br>
                <button type="submit" name="submit" class="btn btn-primary" id="submit">Submit</button>
              </form>
              
          </div>
          <br> <br>
          
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
    <script>

    $(document).ready(function() {
        function disableBack() { window.history.forward() }
        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
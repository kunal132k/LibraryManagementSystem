<?php 
include("data.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library Management System</title>
    <style type="text/css">
        body {
            background-color: #4064AD;
            font-family: sans-serif;
            background-size: 350%;
            background-position: center;
            height: 110%;
        }
        .container {
            z-index: 1;
            box-shadow: 10px 10px 8px #888888;
            margin-top: 60px;
            text-align: center;
            background-color: whitesmoke;
            margin-left: auto;
            margin-right: auto;
            width: fit-content;
            height:500px;
            padding-top: 30px;
            padding-bottom: 30px;
            padding-left: 10px;
            padding-right: 10px;
            border-radius: 28px;
        }
        .bt{
             font-size: 25px;
             margin: 20px; 
             height: 2em;
             padding: 10px;
             background-color:#4064AD;
             color: aliceblue;
        }
        h1 {
            font-size: 35px;
        }
        #p1 {
            font-size: 25px;
        }
        a {
            color:inherit;
            text-decoration: none;
        }
        .flip-card {
            background-color: transparent;
            width: 150px;
            height: 150px;
            border: 1px solid #f1f1f1;
            float: left;
            perspective: 1000px; /* Remove this if you don't want the 3D effect */
        }

        /* This container is needed to position the front and back side */
        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }

        /* Do an horizontal flip when you move the mouse over the flip box container */
        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        /* Position the front and back side */
        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden; /* Safari */
            backface-visibility: hidden;
            
        }

        /* Style the front side (fallback if image is missing) */
        .flip-card-front {
            background-color:whitesmoke;
            color: black;
        }

        /* Style the back side */
        .flip-card-back {
            background-color: #4064AD;
            color: white;
            transform: rotateY(180deg);
            border-radius: 20px;
        }
        #card3 {
            margin-left: 120px;
            margin-top: 15px;
        }
        #card1 {
            margin-left: 25px;
            padding: 10px;
        }
        #card2 {
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome To XYZ Library</h1>
        <p id="p1">"When in doubt go to the library"</p>
        <a href="admin.php">
            <div class="flip-card" id="card1">
            <div class="flip-card-inner">
              <div class="flip-card-front">
                <img src="admin2.png" alt="Avatar" style="width:150px;height:150px;">
              </div>
              <div class="flip-card-back">
                  <br>
                <h3>To Open Admin Login</h3>
                <p>Click Here!</p>
              </div>
            </div>
          </div>
        </a>
        <a href="librarian.php"><div class="flip-card" id="card2">
            <div class="flip-card-inner">
              <div class="flip-card-front">
                <img src="ll.png" alt="Avatar" style="width:150px;height:150px;">
              </div>
              <div class="flip-card-back">
                <br>
                <h3>To Open Librarian Login</h3>
                <p>Click Here!</p>
              </div>
            </div>
          </div>
        </a> <br>
        <a href="student.php"><div class="flip-card" id="card3">
            <div class="flip-card-inner">
              <div class="flip-card-front">
                <img src="st.png" alt="Avatar" style="width:150px;height:150px;">
              </div>
              <div class="flip-card-back">
                <br>
                <h3>To Open Student Login</h3>
                <p>Click Here!</p>
              </div>
            </div>
          </div>
        </a>
    </div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
    <script>

    $(document).ready(function() {
        function disableBack() { window.history.forward() }
        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });
    </script>
</body>
</html>
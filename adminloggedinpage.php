<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="adminloggedinpage.css">
    <title>Admin Logged In Page</title>
   <style>
        body {
            background-color:white;
            font-size: 30px;
        }
        #cc {
            margin-left: 120px;
        }
        .inp {
            background-color:whitesmoke;
            width:60%;
            margin-left: 160px;
        }
        h1 {
            font-size: 80px;
            margin-left: 420px;
        }
        .table {
            width: 95%;
        }
        .z {
            margin-top:30px;
        }
   </style> 
   
</head>
<body>
    <div>
        <a href="home.php"><img src="unnamed.png" alt="img" style="width:150px;height:70px;"></a>    
        <h1>List of Librarians</h1>
    </div>
<div class="container z">
    <?php require_once 'process.php'; ?>
    <?php
        include("data.php");
        $result = mysqli_query($link,"SELECT * FROM `librarian_login_details`");
    ?>
    
    <div class="container">
        <table class="table table-sm table-dark">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <?php 
                while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo  $row['username'] ?></td>
                    <td><?php echo  $row['password'] ?></td>
                    <td>
                        <a href="adminloggedinpage.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
        </table>
    </div>
  
    <div action="process.php" class="row justify-content-center inp">
        <form action="" method="POST">
            <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="user1">Name</label> <br>
                <input type="text" id="user1" name="user1" value="<?php echo $namee ?>">
            </div>
            <div class="form-group">
                <label>Password</label> <br>
                <input type="text" name="pass1" value="<?php echo $passs ?>">
            </div>    
                
                <?php if ($update == true): ?> 
                    <button type="submit" id="cc" name="update" class="btn btn-info">Update</button>
                <?php else: ?> 
                    <button type="submit" id="cc" name="save" class="btn btn-success">Add</button>
                <?php endif; ?> 
            </div>
        </form>
    </div>
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
    </div>
</body>
</html>
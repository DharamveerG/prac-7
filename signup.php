<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<link rel="stylesheet" href="dataForm.css">
    <title>User Data</title>
  </head>
  <body>
    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand navbrand" href="#">
      User Data
      </a>
    </nav>
    <div class="formdiv">
      <form action="phpfiles/signup.bg.php" method="post">
    <h4 class="FormText">User Data Form</h4>
    <?php
    $fullUrl ="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if(strpos($fullUrl,"error=emptyfields")==true){
echo"<p>Empty Fields</p>";

    }
    elseif(strpos($fullUrl,"error=invalidEmail")==true){
      echo"<p>Invalid Email</p>";
      
          }
          elseif(strpos($fullUrl,"error=error=sqlerror")==true){
            echo"<p>Server error</p>";
           
                }
                

    ?>
        <div class="col-auto">
          <label class="sr-only" for="emailId">Email</label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text">.com</div>
            </div>
            <input type="text" class="form-control" name="emailId" id="emailId"  placeholder="Username">
          </div>
        </div>
        <div class="col-auto">
          <label class="sr-only" for="userId">Username</label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text">@</div>
            </div>
            <input type="text" class="form-control" name="userId"  id="userId"  placeholder="Username">
          </div>
        </div>
       

        
          <button type="submit" <?php if(strpos($fullUrl,"submitted")==true){
                  echo'class="btn btn-success submitbtn "';
                  
                      } ?>
                   class="btn btn-primary submitbtn"   name="submit">Submit</button>
        
      </form>
    </div>

    <?php
  require 'phpfiles\connect.db.php';


$sql = "SELECT * FROM users"; 
$result = $dbconn->query($sql); ?>

    <table class="table UserTable" >
      <thead class="table-dark" >
        <tr>
          <th>id</th>
          <th>userId</th>
          <th>emailId</th>
        </tr>
      </thead>
    

      <?php   
                while($rows=$result->fetch_assoc()) { ?>
                  <tbody>
      <tr>
        <td><?php echo $rows['Id'];?></td>
        <td><?php echo $rows['userId'];?></td>
        <td><?php echo $rows['emailId'];?></td>
      </tr>
    </tbody>
      <?php
                }
             ?>
    </table>
  </body>
</html>

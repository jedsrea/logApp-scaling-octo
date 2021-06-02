<?php
  require('config/config.php');
  require('config/db.php');
  
  if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    // $sql = "select *from account where username = '$username' and password = '$password'";  
    //     $result = mysqli_query($conn, $sql);  
    //     $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    //     $count = mysqli_num_rows($result);  
          
    //     if($count == 1){  
    //         header("Location: guestbook-list.php");
    //     }  
    //     else{
    //       echo "<h1> $result </h1>";  
    //         echo "<h1> $username $password</h1>";  
    //         echo "<h1> Login failed. Invalid username or password.</h1>";  
    //     }     

       if ($username != "" && $password != ""){

        $sql_query = "select count(*) as cntUser from account where username='".$username."' and password='".$password."'";
        $result = mysqli_query($conn,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0){
            $_SESSION['username'] = $username;
            header('Location: guestbook-list.php');
        }else{
            echo "<h3 align=\"center\">Invalid username and password</h3>";
        }

    }
  }


?>
<?php include('inc/header.php'); ?>
  <br/>
  <div style="width:30%; margin: auto; text-align: center;">
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" class="form-signin">
      <img class="mb-4" src="img/bootstrap.svg" alt="" width="100" height="100">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Username</label>
      <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="" autofocus="">
      <br/><label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button type="submit" name="submit" value="Submit" class="btn btn-lg btn-primary btn-block">Sign in</button>

    </form>
  </div>
<?php include('inc/footer.php'); ?>
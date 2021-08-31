<?php
require_once("nocache.php");
$errorMessage = '';
// check that the form has been submitted
if(isset($_POST['submit'])) {

 if(empty($_POST['email']) || empty($_POST['password'])) {
     $errorMessage = "A password or email is required";
 }
  else{

  require_once("conn.php");

  $email = $dbConn->escape_string($_POST['email']);
  $password = $dbConn->escape_string($_POST['password']);

  // hash the password so it can be compared with the db value
  $hashedPassword = hash('sha256', $password);

  // query the db
  $sql = "select email, password from leagueAdmin where email = '$email' and password = '$hashedPassword'";
  $results = $dbConn->query($sql);





 //  check number of rows in record set
 if($results->num_rows) {
     session_start();

      // Store the user details in session variables
      $user = $results->fetch_assoc();

      $_SESSION['password'] = $user['password'];
      // Redirect the user to the secure page
      header('Location: scoreEntry.php');
  }

  else {
      $errorMessage = "Invalid Username or Password";
  }

}

}
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/projectMaster.css">
    <script src = "javascript/loginValidation.js"></script>
</head>
<body>
    <nav class="nav">
        <div class ="homePage">
            <a href="index.php">A-League</a> <br> <br>
        </div>
        <a href="ladder.php">Ladder</a>
        <a href="fixtures.php">Fixtures </a>
        <a href="scoreEntry.php">Enter Results</a>
        <?php if (isset($_SESSION["password"])){?>
            <a class = "logoff" href="logoff.php">Logoff</a>
        <?php } else { ?>
            <a class = "logoff" href="login.php">Login</a>
        <?php } ?>
    </nav>
    <div class="loginBox">
        <div class = "loginTitle">
            <label>Admin Panel</label>
        </div>
        <section class="main">
            <form method="post">
                <div class="formClass">
                    <label class ="formLabel">EMAIL</label>
                    <input class="inputBox" name="email" type="text" placeholder="Email">
                </div>
                <div class="formClass">
                    <label class = "formLabel">PASSWORD</label>
                    <input class="inputBox" name ="password" type="password"  placeholder="Password">
                    <p style="color:red;"><?php echo $errorMessage;?></p>
                </div>
                <button name= "submit" type="submit" class="submit">LOGIN</button>
            </section>
        </div>
    </form>
</body>
</html>

<?php

session_start();
  require_once("conn.php");

  if (isset($_POST["submit"])){
      $choice = $_POST["choice"];

    if ($choice == "server"){
      $today = date("Y-m-d");

      $serverSQL = "SELECT * FROM weeks WHERE $today >= startDate AND $today <= endDate";
      $serverResults = $dbConn->query($serverSQL)
      or die ('Problem with query: ' . $dbConn->error);

    }
    else {
      $week = $_POST["weekNum"];
      $sql = "SELECT * FROM weeks WHERE weekID = $week";
      $results = $dbConn->query($sql)
      or die ('Problem with query: ' . $dbConn->error);
    }



  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>A-League Assignment - Choose Week</title>
    <link rel="stylesheet" href="css/projectMaster.css">

    <script>
      function changeSelectionList(){
      if (document.getElementById("weekForm").choice.value == "server")
        document.getElementById("weekNum").disabled = true;
      else
        document.getElementById("weekNum").disabled = false;
      }
    </script>

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
          <h1>A-League Ladder Assignment</h1>
          <form id="weekForm" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
              <p>Do you want to use the Server Date or User Input for the current week?</p>
              <p>
                  <label for="Server">Server Date</label>
                  <input type="radio" id="Server" name="choice" value="server" onclick="changeSelectionList();">
              </p>
              <p>
                  <label for="User">User Input</label>
                  <input type="radio" id="User" name="choice" value="user" onclick="changeSelectionList();">
              </p>
              <p>
                  <label for="weekNum">Week Number:</label>
                  <select class="inputID" id="weekNum" name="weekNum" size="1" disabled>
                      <script>
                      for (i = 1; i <= 24; i++)
                      document.write('<option value="' + i + '">' + i + '</option>');
                  </script>
              </select>
          </p>
          <p><input type="submit" name="submit" value="submit"></p>
      </form>
      <?php
      if (isset($_POST["weekNum"])){ ?>
          <h1>Week <?php echo "$week" ?> Description: </h1>
          <table>
              <tr>
                  <th>Starting Date </th>
                  <th>Ending Date </th>
                  <th>Matches </th>
              </tr>
              <?php while ($row = $results->fetch_assoc()) { ?>
                  <tr>
                      <td><?php echo $row["startDate"]?></td>
                      <td><?php echo $row["endDate"]?></td>
                      <td><?php echo $row["matches"]?></td>
                  </tr>
              </table>
          <?php }
          ?>
          <p>Click on this link if you would like to view the matches for this week</p>
          <a href="fixtures.php">Fixtures</a>
          <?php
      }
      ?>
      <?php if (isset($_POST["submit"])){ ?>
          <?php if ($choice == "server"){ ?>
              <h1>Date <?php echo "$today" ?> Description: </h1>
              <table>
                  <tr>
                      <th>Starting Date </th>
                      <th>Ending Date </th>
                      <th>Matches </th>
                  </tr>
                  <?php while ($Daterow = $serverResults->fetch_assoc()) { ?>
                      <tr>
                          <td><?php echo $Daterow["startDate"]?></td>
                          <td><?php echo $Daterow["endDate"]?></td>
                          <td><?php echo $Daterow["matches"]?></td>
                      </tr>
                  </table>
              <?php }
              ?>
              <p>Click on this link if you would like to view the matches for this week</p>
              <a href="fixtures.php">Fixtures</a>
          <?php }} ?>
</body>
</html>

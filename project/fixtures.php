<?php
session_start();


require_once("conn.php");

        $sql4 =" SELECT * FROM venues";
        $venue = $dbConn->query($sql4)
        or die ('Problem with query: ' . $dbConn->error);

        $query =" SELECT * FROM teams";
        $dropBox = $dbConn->query($query)
        or die ('Problem with query: ' . $dbConn->error);

        $sql = "SELECT * FROM fixtures f, teams t WHERE f.homeTeam = t.teamID";
        $homeTeam = $dbConn->query($sql)
        or die ('Problem with query: ' . $dbConn->error);

        $sql2 = "SELECT * FROM fixtures f, teams t WHERE f.awayTeam = t.teamID";
        $awayTeam = $dbConn->query($sql2)
        or die ('Problem with query: ' . $dbConn->error);

        $sql3 = "SELECT * FROM venues v, fixtures f WHERE v.venueID = f.venueID";
        $venue = $dbConn->query($sql3)
        or die ('Problem with query: ' . $dbConn->error);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <title>A-League Assignment - Choose Week</title>
      <link rel="stylesheet" href="css/projectMaster.css">
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
      <h1>Fixtures Description: </h1>
      <form id="weekForm" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
          <p>
              <label for="weekNum">Week Number:</label>
              <select class="inputID" id="weekNum" name="weekNum" size="1" onchange="this.form.submit()">
                  <script>
                  for (i = 0; i <= 24; i++)
                  document.write('<option value="' + i + '">' + i + '</option>');
              </script>
          </select>
      </p>
  </form>
  <form class="week1form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
      <p>
          <label for="teamS">Team Select:</label>
          <select id="teamS" name="teamS" size="1" onchange="this.form.submit()" >
              <?php while ($team = $dropBox->fetch_assoc()) { ?>
                  <option><?php echo $team["teamName"]; }?> </option>
              </select>
          </p>
      </form>
      <table class = "fixture_ScoreEntry_Table">
          <tr>
              <th>Week</th>
              <th></th>
              <th>Home Team</th>
              <th></th>
              <th>Away Team</th>
              <th>Date</th>
              <th>Start Time</th>
              <th>Venue Name</th>
              <th>HomeScore</th>
              <th>AwayScore</th>
          </tr>
        <?php if (isset($_POST["teamS"])){ ?>
            <?php while ($row = $homeTeam->fetch_assoc()) { ?>
                <?php $awayTeamrow = $awayTeam->fetch_assoc();?>
                <?php $team = $dropBox->fetch_assoc() ?>
                <?php if(($row["teamName"] == $_POST["teamS"]) || ($awayTeamrow["teamName"] ==  $_POST["teamS"])){ ?>
                    <tr>
                        <td><?php echo $row["weekID"]?></td>
                        <td><?php $image_path = "images/".$row['emblem'];
                        echo "<img src = $image_path  height='50' alt = ''>";?></td>
                        <td><?php echo $row["teamName"];?></td>

                        <td><?php $image_path1 = "images/".$awayTeamrow['emblem'];
                        echo "<img src = $image_path1  height='50' alt = ''>";?></td>
                        <td><?php echo $awayTeamrow["teamName"];?></td>
                        <td><?php echo $row["matchDate"]?></td>

                        <td><?php echo $row["matchTime"]?></td>
                        <?php if($venueRow =  $venue->fetch_assoc()){ ?>
                            <?php $id = $venueRow['venueID']; ?>
                            <?php $name = $venueRow['venueName']; ?>
                            <td><?php echo"<a href = 'venue.php?venue=$id'>$name"?></td>
                            <?php  }?>

                            <strong><td><?php echo $row["score1"]?></td></strong>
                            <strong><td><?php echo $row["score2"]?></td></strong>
                    </tr>
            <?php }}}?>
            <?php if (isset($_POST["weekNum"])){ ?>
                <?php while ($row = $homeTeam->fetch_assoc()) { ?>
                    <?php $awayTeamrow = $awayTeam->fetch_assoc();?>
                    <?php $team = $dropBox->fetch_assoc() ?>
                    <?php if($row["weekID"] && $awayTeamrow["weekID"] == $_POST["weekNum"]){ ?>
                        <tr>
                            <td><?php echo $row["weekID"]?></td>
                            <td><?php $image_path = "images/".$row['emblem'];
                            echo "<img src = $image_path  height='50' alt = ''>";?></td>
                            <td><?php echo $row["teamName"];
                            ?></td>

                            <td><?php $image_path1 = "images/".$awayTeamrow['emblem'];
                            echo "<img src = $image_path1  height='50' alt = ''>";?></td>
                            <td><?php echo $awayTeamrow["teamName"]; ?></td>
                            <td><?php echo $row["matchDate"]?></td>
                            <td><?php echo $row["matchTime"]?></td>

                            <?php $venueRow = $venue->fetch_assoc(); ?>
                            <?php if($venueRow =  $venue->fetch_assoc()){ ?>
                            <?php $id = $venueRow['venueID']; ?>
                            <?php $name = $venueRow['venueName']; ?>
                            <td><?php echo"<a href = 'venue.php?venue=$id'>$name"?></td>
                            <?php  }?>
                            <td><?php echo $row["score1"]?></td>
                            <td><?php echo $row["score2"]?></td>
                        </tr>
                    <?php }}}?>

                    <?php while ($row = $homeTeam->fetch_assoc()) { ?>
                        <?php $awayTeamrow = $awayTeam->fetch_assoc();?>
                        <?php $team = $dropBox->fetch_assoc() ?>
                        <tr>
                            <td><?php echo $row["weekID"]?></td>
                            <td><?php $image_path = "images/".$row['emblem'];
                            echo "<img src = $image_path height='50' alt = ''>";?></td>
                            <td><?php echo $row["teamName"]; ?></td>

                            <td><?php $image_path1 = "images/".$awayTeamrow['emblem'];
                            echo "<img src = $image_path1  height='50' alt = ''>";?></td>
                            <td><?php echo $awayTeamrow["teamName"]; ?></td>

                            <td><?php echo $row["matchDate"]?></td>
                            <td><?php echo $row["matchTime"]?></td>

                            <?php if($venueRow =  $venue->fetch_assoc()){ ?>
                                <?php $id = $venueRow['venueID']; ?>
                                <?php $name = $venueRow['venueName']; ?>
                                <td><?php echo"<a href = 'venue.php?venue=$id'>$name"?></td>
                                <?php  }?>

                                <td><?php echo $row["score1"]?></td>
                                <td><?php echo $row["score2"]?></td>
                </tr>
            <?php }?>


    </table>
  </body>
</html>

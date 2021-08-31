<?php
session_start();

  require_once("conn.php");
  $sql = "SELECT * FROM teams ORDER BY points DESC";
  $results = $dbConn->query($sql)
  or die ('Problem with query: ' . $dbConn->error);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Ladder</title>
        <link rel="stylesheet" href="css/projectMaster.css" >

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

<section class="ladderLayout">
    <h1>Ladder as of <?php echo date("d-m-Y"); ?></h1>
        <table class = "ladderTable">
            <tr>
                <th>#</th>
                <th></th>
                <th>Club Name</th>
                <th>P</th>
                <th>W</th>
                <th>L</th>
                <th>D</th>
                <th>GF</th>
                <th>GA</th>
                <th>GD</th>
                <th>PTS</th>
            </tr>
<?php $array = array('teamName', 'played', 'won', 'lost', 'drawn', 'goalsFor', 'goalsAgainst', 'goalDiff', 'points'); ?>
<?php $counter = 0; ?>
<?php while ($row = $results->fetch_assoc()) { ?>

            <tr>
                <td><?php $counter++; echo $counter; ?></td>
                <td><?php $image_path = "images/".$row['emblem'];
                echo "<img src = $image_path  height='50' alt = ''>";?></td>
                <?php foreach ($array as $arrayValue) { ?>
                    <td><?php echo $row[$arrayValue]; ?></td>
                <?php } ?>
            </tr>
        <?php } $dbConn->close(); ?>
</table>
</section>
    </body>
</html>

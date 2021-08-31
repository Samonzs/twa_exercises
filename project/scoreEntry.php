    <?php
    require_once("conn.php");

            $sql4 =" SELECT * FROM venues";
            $venue = $dbConn->query($sql4)
            or die ('Problem with query: ' . $dbConn->error);

            $query =" SELECT * FROM fixtures";
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

             // ensure the page is not cached
              require_once("nocache.php");

             // get access to the session variables
              session_start();



       // check if the user is logged in
        if (!$_SESSION["password"]){
            header("location: login.php");
        }
    ?>




    <!DOCTYPE html>
    <html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Score Entry</title>
        <link rel="stylesheet" href="css/projectMaster.css">
        <script src = "loginValidation.js"></script>
    </head>
    <body>
        <nav class="nav">
            <div class = "homePage">
                <a href="index.php">A-League</a> <br> <br>
            </div>
            <a href="ladder.php">Ladder</a>
            <a href="fixtures.php">Fixtures </a>
            <a href="scoreEntry.php">Enter Results</a>
            <?php if (isset($_SESSION["password"])){?>
                <a class = "logoff" href="logoff.php">Logoff</a>
            <?php }
            else { ?>
                <a class = "logoff" href="login.php">Login</a>
            <?php } ?>
        </nav>
        <h2>Score entry , Select a match you would like to manage</h2>
        <form class="" action="<?php echo $_SERVER["PHP_SELF"]; ?>" onsubmit="return scoreEntry()" method="post" novalidate>
            <div class="dropdown">
                <label for="weekSel">Week Number:</label>
                <select class="inputID" id="weekSel" name="weekSel" size="1" onchange="this.form.submit()">
                    <script>
                    for (i = 0; i <= 24; i++)
                    document.write('<option value="' + i + '">' + i + '</option>');
                </script>
            </select>
        </p>
    </div>
    </form>

    <form class="" action="<?php echo $_SERVER["PHP_SELF"]; ?>" onsubmit="return scoreEntry()" method="post" novalidate>
        <div class="dropdown">
            <p>
                <label for="inputMatchID">Match ID Number:</label>
                <select class="inputID" name="inputMatchID" size="1" onchange="this.form.submit()">
                    <?php while ($team = $dropBox->fetch_assoc()) { ?>
                        <?php if ($team['score1'] == ''){ ?>
                            <option><?php echo $team["matchID"];?></option> <?php } ?>
                        <?php } ?>
                    </select>
                </p>
            </div>
        </form>
        <?php if (isset($_POST["weekSel"])){ ?>
            <table class = "fixture_ScoreEntry_Table">
                <h3>Fixtures Description: </h3>
                <tr>
                    <th>Week</th>
                    <th>Match ID</th>
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
                <?php while ($row = $homeTeam->fetch_assoc()) {
                    $awayTeamrow = $awayTeam->fetch_assoc();
                    if(($row["weekID"]  == $_POST["weekSel"]) && ($awayTeamrow["weekID"] == $_POST["weekSel"]) ){ ?>
                        <tr>
                            <td><?php echo $row["weekID"]?></td>
                            <td><?php echo $row["matchID"]?></td>
                            <td>
                                <?php $image_path = "images/".$row['emblem'];
                                echo "<img src = $image_path  height='50'>";?></td>
                                <td><?php echo $row["teamName"];
                                ?></td>
                                <td><?php if($awayTeamrow["teamID"] == $awayTeamrow["awayTeam"]){
                                    $image_path1 = "images/".$awayTeamrow['emblem'];
                                    echo "<img src = $image_path1 height='50'>";?></td>
                                    <td><?php echo $awayTeamrow["teamName"];
                                }?></td>
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
                        <?php }
                        }
                }?>
            </table>
            <?php if (isset($_POST["inputMatchID"])){ ?>
                <table class = "fixture_ScoreEntry_Table">
                    <tr>
                        <th>Week</th>
                        <th>Match ID</th>
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
                    <?php while ($row = $homeTeam->fetch_assoc()) { ?>
                        <?php $awayTeamrow = $awayTeam->fetch_assoc();?>
                        <?php $team = $dropBox->fetch_assoc() ?>
                        <?php if($row["matchID"] == $_POST["inputMatchID"]){ ?>
                            <tr>
                                <td><?php echo $row["weekID"]?></td>
                                <td><?php echo $row["matchID"]?></td>
                                <td><?php if($row["teamID"] == $row["homeTeam"]){
                                    $image_path = "images/".$row['emblem'];
                                    echo "<img src = $image_path height='50'>";?></td>
                                    <td><?php echo $row["teamName"];
                                }?></td>
                                <td><?php if($awayTeamrow["teamID"] == $awayTeamrow["awayTeam"]){
                                    $image_path1 = "images/".$awayTeamrow['emblem'];
                                    echo "<img src = $image_path1 height='50'>";?></td>
                                    <td><?php echo $awayTeamrow["teamName"];
                                }?></td>
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
                            <?php }
                        }?>
                    </table>
                    <?php  $errorMessage = ''; ?>
                    <form class="" action="<?php echo $_SERVER["PHP_SELF"]; ?>" onsubmit="return scoreEntry()" method="post" novalidate>
                        <div class="InputAlignment">
                            <h2>Update Details:</h2>
                            <label><br>Enter Home Score:</label>
                            <input class="inputID" type="text" id ="score1input" name="score1input" placeholder="score 1"><div id = "score1error" class="errorMsg">Invalid input</div><br>
                            <label><br>Enter Away Score:</label>
                            <input class="inputID" type="text" id ="score2input" name="score2input" placeholder="score 2"><div id = "score2error" class="errorMsg">Invalid input</div>
                            <p style="color:red;"><?php echo $errorMessage;?></p>
                            <input type="hidden" name="inputMatchID" value="<?php echo $_POST["inputMatchID"] ?>">
                            <button class ="submit" type="submit" name="submit">Submit</button>
                        </div>
                    </form>
                <?php } ?>
                <script>
                function scoreEntry(){
                    var valid = true;
                    var score1 = document.getElementById('score1input').value;
                    var score1error = document.getElementById('score1error');
                    var score_reg = /^[0-9]*$/

                    var score2 = document.getElementById('score2input').value;
                    var score2error = document.getElementById('score2error');
                    score1error.style = "";

                    if (!score_reg.test(score1)  && !score1 == '')   {
                    score1error.style = "display: inline-block;"
                    valid = false;
                }
                score2error.style = "";
                if (!score_reg.test(score2)  && !score2 == '')   {
                    score2error.style = "display: inline-block;"
                    valid = false;
                }
                return valid;
            }
        </script>
    <?php
    if(isset($_POST['submit'])) {
        $score1 = $_POST['score1input'];
        $score2 = $_POST['score2input'];
        $Idmatch1 = $_POST['inputMatchID'];
        if(empty($score1) || empty($score2)) {
            echo "<p style='color:red;'>The home or away team score boxes are empty, please enter a value</p>";
        }    ?>
        <?php
        $query = "UPDATE fixtures SET score1 = '$score1', score2 ='$score2' WHERE matchID = '$Idmatch1'";
        $matchresults = $dbConn->query($query)
        or die ('Problem with query: ' . $dbConn->error);
        if($matchresults == 1) {
            echo "<p style='color:green;'>You have successfully submited a completed match , match ID: $Idmatch1 </p>";
        }
     }
     ?>
    </body>
    </html>

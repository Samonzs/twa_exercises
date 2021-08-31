<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Week 8 Exercise 1</title>
    </head>
    <body>
        <?php
        //obtain the firstname input from the $_GET array
        $namestr = $_POST["firstname"];
        $emailstr = $_POST["email"];
        $postalAddstr = $_POST["postaddr"];
        $favSportstr = ["Nothing was selected"];

        $mailListstr = "No";
        if(isset($_POST["emaillist"]))
        {
            $mailListstr = $_POST["emaillist"];
        }

        if(isset($_POST["favsport"]))
        {
            $favSportstr = $_POST["favsport"];
        }
        //obtain the values for the other input devices here
        ?>

        <p>The following information was received from the form:</p>
        <p><strong>Name = </strong> <?php echo "$namestr"; ?> </p>
        <p><strong>Email = </strong> <?php echo "$emailstr"; ?> </p>
        <p><strong>Post Address = </strong> <?php echo "$postalAddstr"; ?> </p>
        <p><strong>Favourite Sport = </strong> <?php

        for($i = 0; $i < count($favSportstr); $i++){
            echo " $favSportstr[$i]" ;
        }



        ?> </p>
        <p><strong>Mail List: </strong> <?php echo "$mailListstr"; ?> </p>

        </body>
</html>

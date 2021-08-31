<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Week 8 Exercise 1</title>
    </head>
    <body>
        <?php
        //obtain the firstname input from the $_GET array
        $namestr = $_GET["firstname"];
        $emailstr = $_GET["email"];
        $postalAddstr = $_GET["postaddr"];
        $favSportstr = $_GET["favsport"];

        $mailListstr = "No";
        if(isset($_GET["emaillist"]))
        {
            $mailListstr = $_GET["emaillist"];
        }
        //obtain the values for the other input devices here
        ?>

        <p>The following information was received from the form:</p>
        <p><strong>Name = </strong> <?php echo "$namestr"; ?> </p>
        <p><strong>Email = </strong> <?php echo "$emailstr"; ?> </p>
        <p><strong>Post Address = </strong> <?php echo "$postalAddstr"; ?> </p>
        <p><strong>Favourite Sport = </strong> <?php echo "$favSportstr"; ?> </p>
        <p><strong>Mail List: </strong> <?php echo "$mailListstr"; ?> </p>

        </body>
</html>

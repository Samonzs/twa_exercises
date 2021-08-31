<?php
   // Here is where your preprocessing code goes

   // An example is already given to you for the First Name
   if(isset($_POST['submit']))
   {
       $fname = $_POST['firstname'];
       $email = $_POST["email"];
       $postalAdd = $_POST["postaddr"];
       $favSport = ["Nothing was selected"];

       $mailListstr = "No";
       if(isset($_POST["emaillist"]))
       {
           $mailListstr = $_POST["emaillist"];
       }

       if(isset($_POST["favsport"]))
       {
           $favSport = $_POST["favsport"];
       }
   }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Week 8 Exercise 3 Form</title>
    <link rel="stylesheet" href="css/week8Styles.css">
  </head>
  <body>
    <h1>Week 8 Exercise 3 PHP form demo</h1>
    <form id="userinfo" action="exercise3.php" method="post">
      <p>Please fill in the following form. All fields are mandatory.</p>

      <p>
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="firstname">
      </p>

      <p>
        <label for="email">Email Address:</label>
        <input type="text" id="email" name="email">
      </p>

      <p>
        <label for="addr">Postal Address:</label>
        <textarea rows="5" cols="300" id="addr" name="postaddr"></textarea>
      </p>

      <p>
        <label for="sport">Favourite sport: </label>
        <select id="sport" name="favsport[]" size="4" multiple>
            <option value="soccer">Soccer</option>
            <option value="cricket">Cricket</option>
            <option value="squash">Squash</option>
            <option value="golf">Golf</option>
            <option value="tennis">Tennis</option>
            <option value="basketball">Basketball</option>
            <option value="baseball">Baseball</option>
        </select>
      </p>


      <p>
        <label for="list">Add me to the mailing list</label>
        <input type="checkbox" id="list" name="emaillist" value="Yes">
      </p>

      <p><input type="submit" name ="submit" value="submit"></p>
    </form>

<?php if(isset($_POST['submit'])):?>
        <section id='output'>
            <h2>The following information was received from the form:</h2>
            <p><strong>First Name:</strong> <?php echo $fname; ?></p>
            <p><strong>Email Address:</strong> <?php echo $email; ?></p>
            <p><strong>Postal Address:</strong> <?php echo $postalAdd; ?></p>
            <p><strong>Favourite Sport:</strong>
                <?php
                for($i = 0; $i < count($favSport); $i++){
                    echo " $favSport[$i]" ;
                }
                ?>
            </p>
            <p><strong>Mail list:</strong> <?php echo $mailListstr; ?></p>;
            </section>
        <?php endif;
    ?>
  </body>
</html>

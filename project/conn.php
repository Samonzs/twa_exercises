 <?php

$dbConn = new mysqli('localhost', 'twa113', 'twa1132q', 'A_League2021_113');
    if ($dbConn->connect_error) {
        die('Connection error (' . $dbConn->connect_errno . ')'
        . $dbConn->connect_error);
}
?>

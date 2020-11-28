<?php

$db_adress = "localhost";
$db_login = "root";
$db_pass = "**********";
$db_name = "forum.org";

$con = @mysqli_connect($db_adress, $db_login, $db_pass, $db_name);
if ($con === false) {
    echo "Nie udało się połączyć z bazą dancyh.";
}
mysqli_set_charset($con, "utf8");

?>
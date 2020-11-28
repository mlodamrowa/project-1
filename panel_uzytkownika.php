<?php 
session_start();
if(isset($_SESSION['Logged']))
{
    if($_SESSION['permissions'] == 1)
        {
            header("Location: panel_administratora.php");
            exit();
        }
}
else 
{
    header("Location: zaloguj.php");
} 
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8">
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="login.css">
<link rel="stylesheet" href="fontello/css/fontello.css">
<title>Forum.org</title>


</head>

<body>

<nav class="navUp navbar shadow fixed-top">

    <div class="col-4 navLogo navA">
         <a  href="index.php">Forum.<span class="blueFont">org</span></a>
    </div>

    <div class="col-8 navB">
        <a href="index.php" >Strona Główna</a>
        <a href="spis_tresci.php" >Spis Treści</a>
        <a href="kontakt.php" >Kontakt</a>
        <a href="zaloguj.php" >
            <svg class="bi bi-person-fill blueFont" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
            </svg>
        </a>
        </ul>
    </div>
</nav>

<main  style="height: 1000px;" >

    <div class="col-6 spaceNav float-left ">
<!--dodanie obrazka brakuje -->
        <div class="col-6 float-left" >
            <img src="img/<?php echo $_SESSION['name_image']; ?>.png" alt="Image" width="75" height="75">
            <p><b><?php echo $_SESSION['login']; ?></b></p>
            <p><?php echo $_SESSION['email']; ?></p>
        </div>
        <div class="col-6 float-left text-left" >

            <form action="change_icon.php" method="GET">
                <input type="submit" value="Zmień ikone">
            </form><br>

            <form action="change_email.php" method="GET">
                <input type="submit" value="Zmień email">
            </form><br>

            <form action="change_password.php" method="GET">
                <input type="submit" value="Zmień hasło">
            </form><br>

            <form action="logout.php" method="GET">
                <input type="submit" value="Wyloguj">
            </form><br>
        </div>
        <!--Tu ma byc polaczenie z baza danych w senise ze obrazek i wyswietlenie loginu -->
        <span>
        <?php
            if(isset($_SESSION['e_message']))
            {
                echo $_SESSION['e_message'];
                unset($_SESSION['e_message']);
            }
        ?>
             </span>
    </div>

    <div class="col-6 spaceNav float-left">

    </div>

</main>

<footer class="footBottom col-12" >
    <div class="col-2 float-left" style="color: #333333">.</div>

    <div class="col-8 float-left text-center">
        <p>Copyright 2020 www.Forum.<span class="blueFont">org</span> Wszelkie prawa zastrzeżone.</p>
    </div>

    <div class="col-2 float-left socialIcon " >
        <a href="#" ><i class="icon-facebook-squared blueFont"></i></a>
        <a href="#" ><i class="icon-instagram blueFont"></i></a>
    </div>
</footer>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


</body>

</html>

<?php 


?>
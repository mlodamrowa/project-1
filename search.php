<?php session_start(); 
if(!isset($_POST['search'])) header("Location: index.php");
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
         <a  href="index.php">Forum.<span class=" blueFont">org</span></a>
    </div>

    <div class="col-8 navB">
        <a href="index.php" >Strona Główna</a>
        <a href="spis_tresci.php" class="blueFont">Spis Treści</a>
        <a href="kontakt.php" >Kontakt</a>
        <a href="zaloguj.php" >
            <svg class="bi bi-person-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
            </svg>
        </a>
        </ul>
    </div>
</nav>

<main class="col-12">

<div class="col-12 spaceNav">

    <form action="search.php" method="post">
    <h3><input type="text" name="search" class="search" placeholder="Wyszukaj...">
    <input type="submit"></h3>
    </form>

</div>

<div class="col-12 text-center text float-left">
    <!-- skrypt wyswietlania spisu -->
    <?php
    # oczyszczenie tablicy post
    $search = trim(htmlentities($_POST['search']));

    # ustalenie numeru strony
    require_once('Funkcjephp/connect.php');
    $page = isset( $_GET['page'] ) ? intval( $_GET['page'] ) : 1;
    if( !empty ( $page ) ) filter_input( INPUT_GET , 'page' , FILTER_VALIDATE_INT );
    else $page = 1;

    # wysiwetlenie zawarotsci
    $items_per_page = 7;
    $offset = ($page -1)*$items_per_page;
    $sql = "SELECT * FROM article WHERE (id_article LIKE '%$search%' OR author LIKE '%$search%' OR title LIKE '%$search%') ORDER BY `article`.`id_article` DESC LIMIT $offset ,$items_per_page";
    foreach ($con->query($sql) as $row) {
        echo "<div class='col-9 float-left list'>";
            echo "<h2><a href='#'>";
            echo "<span class='blueFont'>".$row['id_article'] . ".</span> ";
            echo $row['title'];
            echo "</h2></a>";
        echo "</div>";
        echo "<div class='col-3 float-left list'>";
            echo "<p align='center'>"."<span class='blueFont'>Autor:</span> ";
            echo $row['author'] . "<br>";
            echo $row['date'];
            echo "</p>";
        echo "</div>";
        
    }
    # okreslenie ilosci stron
    $sql = "SELECT * FROM article WHERE (id_article LIKE '%$search%' OR author LIKE '%$search%' OR title LIKE '%$search%')";
    $page_count = $con->query($sql);
    $page_count = $page_count->num_rows;
    $page_count = ceil($page_count/$items_per_page);
    $con->close();
    #wyswietlenie ilosci stron
    echo "<div class='col-12 text-center list float-left'>";
        if($page_count != 0){
            $i = $page - 1;
            if($page > 1 ) echo '<a href="./search.php?page='.$i.'">'.'<< '.'</a>';
            if($page > 1 ) echo '<a href="./search.php?page=1">1</a> ...';
            if($page > 1 ) echo '<a href="./search.php?page='.$i.'"> '.$i.'</a>';
            echo '<a class="listCheck" href="./search.php?page='.$page.'"> '.$page.'</a>';
            $i = $page + 1;
            if($page != $page_count) echo '<a href="./search.php?page='.$i.'"> '.$i.'</a>';
            echo ' ... <a href="./search.php?page='.$page_count.'"> '.$page_count.'</a>';
            if($page_count > 1 && $page != $page_count ) echo '<a href="./search.php?page='.$i.'">'.' >>'.'</a>';
            }
        else echo "Brak wyników";    

    echo "</div>";
    
    ?>
    
</div>
<!-- skrypt wyswietlania spisu -->
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
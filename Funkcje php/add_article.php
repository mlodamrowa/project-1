<?php 
session_start();

if(!empty($_SESSION['e_message'])) unset($_SESSION['e_message']);

if(!empty($_POST['title'])){
    if(!empty($_POST['text'])){
        if($_FILES['file']['error'] == UPLOAD_ERR_OK)
        {
            $uploaddir = '../img_article/';
            $new_name = $uploaddir.$_FILES['file']['name'];
            $temp_name = $_FILES['file']['tmp_name'];
            if(move_uploaded_file($temp_name, $new_name))
            {
                
                $ilosc_plikow = scandir('../img_article');
                $i=1;
                foreach($ilosc_plikow as $score){
                    if($score != '..' && $score != '.'){
                        $i++;
                    }
                }
                rename($new_name, '../img_article/'.$i.'.png');
                echo $i;
                require_once('connect.php');
                $login = $_SESSION['login'];
                $title = trim($_POST['title']);
                $text = trim($_POST['text']);
                $sql = sprintf("INSERT INTO article VALUES (null,'%s','%s',NOW(),'%s','%s')",
                    mysqli_real_escape_string($con,$title),
                    mysqli_real_escape_string($con,$login),
                    mysqli_real_escape_string($con,$text),
                    mysqli_real_escape_string($con,$i),
                );
                mysqli_query($con, $sql);
                $_SESSION['e_message'] = "Dodano artykuł.";
                mysqli_close($con);
                header("Location: ../dodaj_artykul.php");
            }
            else{
                $_SESSION['e_message'] = 'Nie udało sie dodac artykułu.';
                header("Location: ../dodaj_artykul.php");
            }
        }
        else
        {   
            $_SESSION['e_message'] = 'Nie udało sie dodac artykułu. Dodaj zdjęcie.';
            header("Location: ../dodaj_artykul.php");
        }
    }
    else{
        $_SESSION['e_message'] = 'Nie udało sie dodac artykułu. Brak opisu.';
        header("Location: ../dodaj_artykul.php");
    }
}
else
{
    $_SESSION['e_message'] = 'Nie udało sie dodac artykułu. Brak tytułu.';
    header("Location: ../dodaj_artykul.php");
}



?>

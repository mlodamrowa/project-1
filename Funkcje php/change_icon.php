<?php 
session_start();
if($_FILES['image']['error'] == UPLOAD_ERR_OK)
{
    $uploaddir = '../img/';
    $new_name = $uploaddir.$_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    if(move_uploaded_file($temp_name, $new_name))
    {
        $_SESSION['e_message'] = "Zmieniono ikone.";
        $ilosc_plikow = scandir('../img');
        $i=1;
        foreach($ilosc_plikow as $score){
            if($score != '..' && $score != '.'){
                $i++;
            }
        }
        rename($new_name, '../img/'.$i.'.png');
        echo $i;
        require_once('connect.php');
        $login = $_SESSION['login'];
        $sql = sprintf("UPDATE users SET name_image = '%d' WHERE BINARY loginUser = '%s'",
            mysqli_real_escape_string($con,$i),
            mysqli_real_escape_string($con,$login),
        );
        mysqli_query($con, $sql);
        $_SESSION['name_image'] = $i;
        mysqli_close($con);
        header("Location: ../panel_administratora.php");
    }
    else{
        $_SESSION['e_message'] = 'Nie udało sie zmienić ikony.';
        header("Location: ../panel_administratora.php");
    }
}
else
{   
    $_SESSION['e_message'] = 'Nie udało sie zmienić ikony.';
    header("Location: ../panel_administratora.php");
}

?>
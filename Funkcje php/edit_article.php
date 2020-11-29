<?php session_start(); 
if(!isset( $_SESSION['Logged'] ) && $_SESSION['permissions'] == 1){
    header("location: index.php");
}
if(empty( $_GET['edit'] )) header("location: index.php");
$id_article = $_GET['edit'];
require_once('connect.php');
$sql = "SELECT * FROM article WHERE id_article = '$id_article'";
if($con->query($sql)->fetch_row() != 0)
{
    if( $_FILES['file']['error'] == UPLOAD_ERR_NO_FILE )
    {
        $title = trim( htmlentities( $_POST['title'] ) );
        $text = trim( htmlentities( $_POST['text'] ) );
        $sql = sprintf("UPDATE `article` SET `title` = '%s', `text` = '%s' WHERE `article`.`id_article` = $id_article;",
        mysqli_real_escape_string($con,$title),
        mysqli_real_escape_string($con,$text),
        );
        if($con->query($sql))
        {
            $_SESSION['e_message'] = 'Artykuł został zmieniony.';
            $con->close();
            header("location: ../panel_administratora.php");
        }
        else
        {
            $_SESSION['e_message'] = 'Nie udało się zmienić artykułu.';
            $con->close();
            header("location: ../panel_administratora.php");
        } 
    }
    elseif( $_FILES['file']['error'] == UPLOAD_ERR_OK )
    {
        $sql = "SELECT image_article FROM article WHERE `article`.`id_article` = $id_article ";
        $img = $con->query($sql)->fetch_assoc();

        if(!empty($img))
        {
            $del = '../img_article/'.$img['image_article'].'.png';
            unlink($del);
        }

        $uploaddir = '../img_article/';
        $new_name = $uploaddir.$_FILES['file']['name'];
        $temp_name = $_FILES['file']['tmp_name'];
        if(move_uploaded_file($temp_name, $new_name))
            {
                
                rename($new_name, '../img_article/'.$img['image_article'].'.png');
                require_once('connect.php');
                $title = trim( htmlentities( $_POST['title'] ) );
                $text = trim( htmlentities( $_POST['text'] ) );
                $sql = sprintf("UPDATE article SET SET `title` = '%s', `text` = '%s', `image_article` = '%s' WHERE `article`.`id_article` = $id_article",
                    mysqli_real_escape_string($con,$title),
                    mysqli_real_escape_string($con,$text),
                    mysqli_real_escape_string($con,$img['image_article']),
                );
                $con->query($sql);
                $_SESSION['e_message'] = "Artykuł został zmieniony.";
                mysqli_close($con);
                header("location: ../panel_administratora.php");
            }
            else{
                $_SESSION['e_message'] = 'Nie udało się zmienić artykułu.';
                header("location: ../panel_administratora.php");
            }
    }
    
}
else
{   
    $con->close();
    header("location: ../index.php");
} 

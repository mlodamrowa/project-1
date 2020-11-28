
<?php
function login()
{

    if(isset($_POST['login']) && isset($_POST['password']))
    {

        $login = trim(htmlentities($_POST['login'],ENT_QUOTES,"UTF-8"));
        $password = trim(htmlentities($_POST['password'],ENT_QUOTES,"UTF-8"));
        require_once('Funkcje php/connect.php');
        $sql = sprintf("SELECT loginUser FROM users WHERE BINARY loginUser = '%s'",mysqli_escape_string($con,$login));
        $go = @mysqli_query($con, $sql);
        if(@mysqli_fetch_row($go) === 0)
        {
            echo "Taki login nie istnieje.";
            mysqli_close($con);
        }
        else
        {
            $sql = sprintf("SELECT * FROM users WHERE  BINARY loginUser = '%s'",
            mysqli_escape_string($con,$login),
            );
            $go = @mysqli_query($con, $sql);
            $score = $go->fetch_assoc();
            if(!password_verify($password,$score['password']))
            {
                echo "Złe hasło.";
            }
            else 
            {   
                
                $user = $score['loginUser'];
                $_SESSION['login'] = $user;
                $user = $score['email'];
                $_SESSION['email'] = $user;
                $user = $score['permissions'];
                $_SESSION['permissions'] = $user;
                $user = $score['name_image'];
                $_SESSION['name_image'] = $user;
                $_SESSION['Logged'] = 1;
                if($_SESSION['permissions'] == 1)
                {
                    header("Location: panel_administratora.php");
                }
                else 
                {
                    header("Location: panel_uzytkownika.php");
                }
                
            }
            mysqli_close($con);
            
        }
        


    }
    
}

?>
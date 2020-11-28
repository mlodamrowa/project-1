<?php 
function register()
{
    if(isset($_POST['password']) && isset($_POST['repeatPassword']))
    {
        $pass1 = trim(htmlentities($_POST['password'],ENT_QUOTES,"UTF-8"));
        $pass2 = trim(htmlentities($_POST['repeatPassword'],ENT_QUOTES,"UTF-8"));
        

        if($pass1 != $pass2)
        {
            echo 'hasła nie są do siebie podobne.';
        }
        else
        {
        
            if (isset($_POST["login2"]) && isset($_POST["email"])) 
            {
                $passHash = password_hash($pass1, PASSWORD_DEFAULT);
                $login = trim(htmlentities($_POST["login2"],ENT_QUOTES,"UTF-8"));
                $email = trim(htmlentities($_POST["email"],ENT_QUOTES,"UTF-8"));

                require_once('Funkcje php/connect.php');

                $sql = sprintf("SELECT loginUser FROM users WHERE BINARY loginUser='%s'",mysqli_real_escape_string($con,$login));
                $go = @mysqli_query($con,$sql) or die('Błąd zapytania');
                if(mysqli_fetch_row($go) == 0)
                    {
                        $sql = sprintf("SELECT email FROM users WHERE BINARY email='%s'",mysqli_real_escape_string($con,$email));
                        $go = @mysqli_query($con,$sql) or die('Błąd zapytania');
                        if(mysqli_fetch_row($go) == 0)
                        {

                            $sql = sprintf("INSERT INTO users VALUES ('%s', '%s', '%s', '0', '1')  ",
                            mysqli_real_escape_string($con,$login),
                            mysqli_real_escape_string($con,$passHash),
                            mysqli_real_escape_string($con,$email),
                            );
                            $go = @mysqli_query($con, $sql) or die('Błąd zapytania');
                            if($go)
                            {
                                echo "Zarejetsrowano.";
                            }
                            else 
                            {
                                echo "Nie zarejestrowano.";
                            }
                        }
                        else
                        {
                            echo "Taki email już istnieje.";
                        }
                        mysqli_close($con);
                    }

                else 
                {
                    echo "Taka nazwa już istnieje.";
                    mysqli_close($con);
                
                }

            }

            
            
        }
    }
    
}

?>
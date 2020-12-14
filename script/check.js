function check_login()
{
    var login = document.getElementsByClassName('login');
    var error = '';
    if(login[0].value  === '')
    {
        error = error + "<br>Podaj login ";
    }
    if(login[1].value === '')
    {
        error = error + "<br>Podaj hasło ";
    }
    else
    {
        if(login[1].value.length < 8)
        {
            error = error + "<br>Hasło musi byc dluższe niż 7 znaków ";
        }
    }
    if(error !== '')
    {   
        login[2].disabled = true;
        var e = document.getElementById('check_login');
        e.style.color = '#ff0000';
        e.innerHTML = '<b>'+error+'</b>';
    }
    else login[2].disabled = false;
}
function check_register()
{
    var register = document.getElementsByClassName('register');
    var error = '';
    if(register[0].value  === '')
    {
        error = error + "<br>Podaj login ";
    }
    if(register[1].value === '')
    {
        error = error + "<br>Podaj hasło ";
    }
    else
    {
        
        if( (register[1].value.length < 8) || (register[1].value.length > 12) )
        {
            error = error + "<br>Nie prawidłowa dlugość znaków<br>Minimalna dlugosc hasła to 8 znaków. Maksymalna długosc hasła to 12";
        }

        if(/[0-9]{1,}/.test(register[1].value) === false)
        {
            error = error + "<br>Hasło musi posiadać przynajmniej jedną cyfre";
        }

        if(/[A-Z]{1,}/.test(register[1].value) === false)
        {
            error = error + "<br>Hasło musi posiadać przynajmniej jedną dużą litere";
        }
        var q = 0;
        if(/[^a-zA-Z0-9_]{1,}/.test(register[1].value) === false)
        {
            error = error + "<br>Hasło musi posiadać przynajmniej jeden znak specjalny";
            q = 1;
        }
        if(q==0)
        {
            if(register[2].value !== '')
            {
                if(register[1].value !== register[2].value)
                {
                    error = error + "<br>Hasła nie są takie same";
                }
            }
        }
    }
    if(register[3].value === '')
        error = error + "<br>Podaj adres email";
    else
    {
        if(/^[-\w\.]+@([-\w]+\.)+[a-z]+$/i.test(register[3].value === false))
            error = error + "<br>Błędny adres email";
    }
    
    if(error !== '')
    {   
        register[4].disabled = true;
        var e = document.getElementById('check_register');
        e.style.color = '#ff0000';
        e.innerHTML = '<b>'+error+'</b>';
    }
    else register[4].disabled = false;
}
var el1 = document.getElementById('login');
var el2 = document.getElementById('register');
el1.addEventListener('blur', check_login, true);
el2.addEventListener('blur', check_register, true);


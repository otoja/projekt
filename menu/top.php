<?php

/**
 * Description of top
 *
 * @author kama
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/auth.php';

echo '<ul>';
if (isset($_SESSION['logedin']) && $_SESSION['logedin']) echo '<li><a href="javascript:getData(\'./engine/processLoginForm.php?mode=logout\',\'cont\')"  onclick="javascript:location.reload(true)">Wyloguj</a></li>';
if(empty($_SESSION))echo '<li><a href="javascript:getData(\'./forms/loginForm.php\',\'cont\')">Zaloguj</a></li>';
echo '<li><a href="javascript:getData(\'./mod/modelUser.php?mode=pacjent\',\'cont\')">Zarejestruj</a></li>
    <li><a href="#">Nowości</a></li>
        <li><a href="#">Kontakt</a></li>
        
    </ul>';

?>
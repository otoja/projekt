<?php

/**
 * Description of admin
 *
 * @author kama
 */
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/mod/modEpr.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/auth.php';
if (isset($_SESSION['mode'])) {
    switch ($_SESSION['mode']) {
        case 'admin':
            echo '<li><a href="./mod/modEpr.php?type=new">Opisz wizytę</a></li>
                        <li><a href="./mod/modEpr.php?type=skier">Wypisz skierowanie</a></li>
                        <li><a href="./mod/modEpr.php?type=rec">Wypisz recepte</a></li>
                        <li><a href="./mod/modEpr.php?type=zlec">Wypisz zlecenie</a></li>
                        <li><a href="./engine/processLoginForm.php?mode=logout">Wyloguj</a></li>';
            break;
        case 'lekarz':
            if (!isset($_SESSION['pident']) || !empty ($_SESSION['pident'])) {
                echo "<form method='POST' action=".$_SERVER['PHP_SELF'].'?go=new'.">";
                echo "Aby opisać wizytę podaj identyfikator pacjenta: <input name='pident' type='text'>";
                echo "<input type='submit' value='dalej'>";
            }
            if (isset($_POST['pident']) || !empty ($_POST['pident'])) {
                $_SESSION['pident']=$_POST['pident'];
                echo "Identyfikator aktywnego pacjenta: <input name='pident' type='text' value=".$_SESSION['pident']." DISABLED >";
                $epr=new modEpr();
                ?>
                <h2>opisz wizytę</h2>
                <?
                $epr->addEprNote();

            }
            echo '<li><a href="./engine/processLoginForm.php?mode=logout">Wyloguj</a></li>';
            break





            ;
        case 'pacjent':?>
            <li><a href="./content/promocje.php">Promocje</a></li>
            <li><a href="./content/czytelnia">Czytelnia</a></li>
            <li><a href="./mod/modEpr.php?type=wyswietl&gen=all">Moja historia choroby</a></li>
            <li><a href="./mod/modEpr.php?type=wyswietl&gen=recepty">Wypisane recepty</a></li>
            <li><a href="./content/bmi.php">Kalkulator BMI</a></li>
            <li><a href="./content/czytelnia">Uwarunkowania prawne</a></li>
            <li><a href="./content/czytelnia">Karta pacjenta</a></li>
            <li><a href="./engine/processLoginForm.php?mode=logout">Wyloguj</a></li>
            <?break;
        case 'administracja':
            echo '
             <li><a href="./mod/modelUser.php?type=urlop">Wprowadź urlop pracownika</a></li>
             <li><a href="./mod/modelUser.php?mode=pracownik">Dodaj pracownika</a></li>
             <li><a href="./mod/modelUser.php?mode=lekarz">Dodaj lekarza</a></li>
             <li><a href="./engine/processLoginForm.php?mode=logout">Wyloguj</a></li>';
            break;
        case 'rejestracja':
            echo '
            <li><a href="./mod/modelUser.php?type=aktyw">Kolejka oczekujących</a></li>
            <li><a href="./mod/modelUser.php?type=aktyw">Wyznacz wizytę</a></li>
            <li><a href="./mod/modelUser.php?type=aktyw">Aktywuj konto pacjenta</a></li>
            <li><a href="./engine/processLoginForm.php?mode=logout">Wyloguj</a></li>';
            break;
        default:
            break;
    }
}else echo ' <li><a href="javascript:getData(\'./mod/modelUser.php?mode=pacjent\',\'cont\')">Załóż konto</a></li>
             <li><a href="javascript:getData(\'./content/promocje.php\',\'cont\')">Promocje</a></li>
             <li><a href="./content/czytelnia">Czytelnia</a></li>
             <li><a href="./content/bmi.php">Kalkulator BMI</a></li>
             <li><a href="./content/czytelnia">Uwarunkowania prawne</a></li>
             <li><a href="./content/czytelnia">Karta pacjenta</a></li>
             ';
?>

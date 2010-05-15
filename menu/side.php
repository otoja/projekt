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
            echo '<ul><li><a href="#">Pracownicy</a></li>
                <li><a href="#">Dodaj lekarza</a></li>
                <li><a href="#">Pracownicy</a></li></ul>';

                        
                        
            break;
        case 'lekarz':
         echo  '<ul><li><a href="#">Wizyta</a></li>
            <ul> <li><a href="javascript:getData(\'./mod/modEpr.php?type=new\',\'cont\')">Opisz wizytę</a></li>
                 <li><a href="javascript:getData(\'./mod/modEpr.php?type=skier\',\'cont\')">Wypisz skierowanie</a></li>
                <li><a href="javascript:getData(\'./mod/modEpr.php?type=rec\',\'cont\')">Wypisz recepte</a></li>
                <li><a href="javascript:getData(\'./mod/modEpr.php?type=zlec\',\'cont\')">Wypisz zlecenie</a></li>
                <ul><li><a href="javascript:getData(\'./content/czytelnia/karta_pacjenta.php\',\'cont\')">Karta pacjenta</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia/epr.php\',\'cont\')">EPR</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia/syst.php\',\'cont\')">O systemie</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia/onas.php\',\'cont\')">O nas</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia/telemedycyna.php\',\'cont\')">Telemedycyna</a></li>
             </ul><li><a href="javascript:getData(\'./content/promocje.php\',\'cont\')">Promocja zdrowia</a></li>
             <li><a href="javascript:getData(\'./content/akcje.php\',\'cont\')">Akcje prozdrowotne</a></li>
             <li><a href="javascript:getData(\'./content/linki.php\',\'cont\')">Linki</a></li>
             <li><a href="javascript:getData(\'./content/bmi.php\',\'cont\')">Kalkulator BMI</a></li>
             <li><a href="javascript:getData(\'./content/czytelnia\',\'cont\')">Normy prawne</a></li></ul>
                
          ';
            break
            ;
        case 'pacjent':
            echo '
            <ul><li><a href="javascript:getData(\'./mod/modEpr.php?type=wyswietl&gen=all\',\'cont\')">Moja historia choroby</a></li>
            <li><a href="javascript:getData(\'./mod/modEpr.php?type=wyswietl&gen=recepty\',\'cont\')">Wypisane recepty</a></li>
            <li><a href="javascript:getData(\'./lib/terminarz/showDoc.php\',\'cont\')">Terminarz</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia\',\'cont\')">Czytelnia</a></li>
            <ul><li><a href="javascript:getData(\'./content/czytelnia/karta_pacjenta.php\',\'cont\')">Karta pacjenta</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia/epr.php\',\'cont\')">EPR</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia/syst.php\',\'cont\')">O systemie</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia/onas.php\',\'cont\')">O nas</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia/telemedycyna.php\',\'cont\')">Telemedycyna</a></li>
             </ul><li><a href="javascript:getData(\'./content/promocje.php\',\'cont\')">Promocja zdrowia</a></li>
             <li><a href="javascript:getData(\'./content/akcje.php\',\'cont\')">Akcje prozdrowotne</a></li>
             <li><a href="javascript:getData(\'./content/linki.php\',\'cont\')">Linki</a></li>
             <li><a href="javascript:getData(\'./content/bmi.php\',\'cont\')">Kalkulator BMI</a></li>
             <li><a href="javascript:getData(\'./content/czytelnia\',\'cont\')">Normy prawne</a></li></ul>';
            break;
        case 'administracja':
            echo '
             <ul>
            <li><a href="javascript:getData(\'./mod/modelUser.php?mode=pracownik\',\'cont\')">Dodaj pracownika</a></li>
             <li><a href="javascript:getData(\'./mod/modelUser.php?mode=lekarz\',\'cont\')">Dodaj lekarza</a></li>
             <li><a href="javascript:getData(\'./mod/modelUser.php?type=urlop\',\'cont\')">Wprowadź urlop pracownika</a></li>
            <ul><li><a href="javascript:getData(\'./lib/terminarz/showDoc.php\',\'cont\')">Terminarz</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia\',\'cont\')">Czytelnia</a></li>
            <ul><li><a href="javascript:getData(\'./content/czytelnia/karta_pacjenta.php\',\'cont\')">Karta pacjenta</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia/epr.php\',\'cont\')">EPR</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia/syst.php\',\'cont\')">O systemie</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia/onas.php\',\'cont\')">O nas</a></li>;
            <li><a href="javascript:getData(\'./content/czytelnia/telemedycyna.php\',\'cont\')">Telemedycyna</a></li>
             </ul><li><a href="javascript:getData(\'./content/promocje.php\',\'cont\')">Promocja zdrowia</a></li>
             <li><a href="javascript:getData(\'./content/akcje.php\',\'cont\')">Akcje prozdrowotne</a></li>
             <li><a href="javascript:getData(\'./content/linki.php\',\'cont\')">Linki</a></li>
             <li><a href="javascript:getData(\'./content/bmi.php\',\'cont\')">Kalkulator BMI</a></li>
             <li><a href="javascript:getData(\'./content/czytelnia\',\'cont\')">Normy prawne</a></li>
             </ul>';
            break;
        case 'rejestracja':
            echo '
            <ul><li><a href="javascript:getData(\'./mod/modelUser.php?type=aktyw\',\'cont\')">Kolejka oczekujących</a></li>
            <li><a href="javascript:getData(\'./mod/modelUser.php?type=aktyw\',\'cont\')">Wyznacz wizytę</a></li>
            <li><a href="javascript:getData(\'./mod/modelUser.php?type=aktyw\',\'cont\')">Aktywuj konto pacjenta</a></li>
            <li><a href="javascript:getData(\'./engine/processLoginForm.php?mode=logout\',\'cont\')">Wyloguj</a></li></ul>
            <ul><li><a href="javascript:getData(\'./lib/terminarz/showDoc.php\',\'cont\')">Terminarz</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia\',\'cont\')">Czytelnia</a></li>
            <ul><li><a href="javascript:getData(\'./content/czytelnia/karta_pacjenta.php\',\'cont\')">Karta pacjenta</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia/epr.php\',\'cont\')">EPR</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia/syst.php\',\'cont\')">O systemie</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia/onas.php\',\'cont\')">O nas</a></li>;
            <li><a href="javascript:getData(\'./content/czytelnia/telemedycyna.php\',\'cont\')">Telemedycyna</a></li>
             </ul><li><a href="javascript:getData(\'./content/promocje.php\',\'cont\')">Promocja zdrowia</a></li>
             <li><a href="javascript:getData(\'./content/akcje.php\',\'cont\')">Akcje prozdrowotne</a></li>
             <li><a href="javascript:getData(\'./content/linki.php\',\'cont\')">Linki</a></li>
             <li><a href="javascript:getData(\'./content/bmi.php\',\'cont\')">Kalkulator BMI</a></li>
             <li><a href="javascript:getData(\'./content/czytelnia\',\'cont\')">Normy prawne</a></li>
             </ul>';
            break;
        default:
            break;
    }
}else echo '<ul><li><a href="javascript:getData(\'./lib/terminarz/showDoc.php\',\'cont\')">Terminarz</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia\',\'cont\')">Czytelnia</a></li>
            <ul><li><a href="javascript:getData(\'./content/czytelnia/karta_pacjenta.php\',\'cont\')">Karta pacjenta</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia/epr.php\',\'cont\')">EPR</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia/syst.php\',\'cont\')">O systemie</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia/onas.php\',\'cont\')">O nas</a></li>
            <li><a href="javascript:getData(\'./content/czytelnia/telemedycyna.php\',\'cont\')">Telemedycyna</a></li>
             </ul><li><a href="javascript:getData(\'./content/promocje.php\',\'cont\')">Promocja zdrowia</a></li>
             <li><a href="javascript:getData(\'./content/akcje.php\',\'cont\')">Akcje prozdrowotne</a></li>
             <li><a href="javascript:getData(\'./content/linki.php\',\'cont\')">Linki</a></li>
             <li><a href="javascript:getData(\'./content/bmi.php\',\'cont\')">Kalkulator BMI</a></li>
             <li><a href="javascript:getData(\'./content/czytelnia\',\'cont\')">Normy prawne</a></li>
             </ul>';

// <li><a href="javascript:getData(\'./mod/modelUser.php?mode=pacjent\',\'cont\')">Załóż konto</a></li>
//<li><a href="javascript:getData(\'./mailtest.php\',\'cont\')">Test maila</a></li>
?>

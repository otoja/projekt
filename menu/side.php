<?php

/**
 * Description of admin
 *
 * @author kama
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/mod/modVis.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/mod/modEpr.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/auth.php';
if (isset($_SESSION['mode'])) {
    switch ($_SESSION['mode']) {
        case 'admin':
            echo '<ul><li><a href="#">Pracownicy</a></li>
                <li><a href="#">Dodaj lekarza</a></li>
                <li><a href="#">Pracownicy</a></li></ul>';              
            break;
        case 'lekarz':
         echo  '<ul><li><a href="javascript:getData(\'./mod/modVis.php?type=show_act_visit\',\'cont\')">Wizyty aktywne</a></li>
             <li><a href="javascript:getData(\'./mod/modVis.php?type=show_doc\',\'cont\')">Umówione wizyty</a></li>
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
            <ul><li><a href="javascript:getData(\'./mod/modVis.php?type=show_patient\',\'cont\')">Moje wizyty</a></li>
            <li><a href="javascript:getData(\'./mod/modEpr.php?id=17\',\'cont\')">Moja historia choroby</a></li>
            <li><a href="javascript:getData(\'./mod/modVis.php?type=wyswietl&gen=recepty\',\'cont\')">Wypisane recepty</a></li>
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
             <li><a href="javascript:getData(\'./content/czytelnia\',\'cont\')">Normy prawne</a></li>
             </ul>';
            break;
        case 'rejestracja':
            echo '
            <ul><li><a href="javascript:getData(\'./mod/modVis.php?type=show\',\'cont\')">Dzisiejsze wizyty</a></li>
           <li><a href="javascript:getData(\'./mod/modVis.php?type=show_all\',\'cont\')">Wszytskie wizyty</a></li>
           <li><a href="javascript:getData(\'./mod/modelUser.php?type=aktyw\',\'cont\')">Aktywuj konto pacjenta</a></li>
           <li><a href="javascript:getData(\'./lib/terminarz/showDoc.php\',\'cont\')">Terminarz</a></li>
            <ul><li><a href="javascript:getData(\'./content/czytelnia\',\'cont\')">Czytelnia</a></li>
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

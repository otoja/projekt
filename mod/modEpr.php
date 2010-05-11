<?php


/**
 * Description of modEpr
 *
 * @author kama
 */
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/auth.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/forms/newVisitForm.php';

class modEpr {
    //put your code here
    public function addEprNote() {
           if (isset($_SESSION['mode'])) {
            if($_SESSION['mode']=='rejestracja' || $_SESSION['mode']=='lekarz') {
                $visit=new newVisitForm('../engine/processNewVisitForm.php', 'post');
                $visit->display();
            }else echo 'Nie masz uprawnień do wykonania tej operacji';
        }else echo 'Musisz być zalogowany';
    }

    private function addNewVisit() {
     
    }
}
$vis=new modEpr();
//if (isset($_GET['type'])) {
//    switch ($_GET['type']) {
//        case 'new':
//            echo "<form method='POST' action=".$_SERVER['PHP_SELF'].'?go=new'.">";
//            echo "Podaj identyfikator pacjenta: <input name='pident' type='text'>";
//            echo "<input type='submit' value='dalej'>";
//            break;
//        case 'rec':break;
//        case 'skier':break;
//        case 'zlec':break;
//    }
//}

//if (isset($_GET['go'])) $vis->addEprNote();

//if ($_SERVER['REQUEST_METHOD']=='POST') {
//    $add=new processNewVisitForm();
//    $add->validate();
//    $_SESSION['id_wizyta']=$add->addToDb();
//}
?>

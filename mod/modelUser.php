<?php

/**
 * Description of modelUser
 *
 * Klasa do obsługi danych użytkownika
 *
 * @author kama
 */
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/forms/addPatientForm.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/forms/addEmpForm.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/forms/addDocForm.php';
//require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/engine/processAddEmpForm.php';
//require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/engine/processAddPatientForm.php';
//require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/engine/processAddDocForm.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/baseConfig.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/auth.php';

class modelUser {
//put your code here
    //dodawanie uzytkownika w zaleznosci od jego roli w systemie
    public function addUser($mode) {
        switch($mode) {
            case 'pacjent': {
                    $form=new addPatientForm('../engine/processAddPatientForm.php', 'post');
                    $form->display();
                }break;
            case 'pracownik': {
                    $form=new addEmpForm('../engine/processAddEmpForm.php', 'post');
                    $form->display();
                }break;
            case 'lekarz': {
                    $form= new addDocForm('../engine/processAddDocForm.php','post');
                    $form->display();
                }
            default: break;
        }
    }
//edycja danych użytkownika ze wskazanym identyfikatorem
    public function editUser($ident) {
//sprawdzanie kim jest użytkownik
        $mode=$this->getUserMode($ident);
        if ($mode) {
            switch($mode) {
                case 'pacjent': {
                        $form=new addPatientForm($_SERVER['PHP_SELF'], 'post');
                        $form->editForm($ident);
                        $form->display();
                        if ($_SERVER['REQUEST_METHOD']=='POST') {
                            $add=new processAddPatientForm();
                            $add->validate();
                            $add->addToDb();
                        }
                    }break;
                case 'pracownik': {
                        $form=new addEmpForm($_SERVER['PHP_SELF'], 'post');
                        $form->editForm($ident);
                        $form->display();
                        if ($_SERVER['REQUEST_METHOD']=='POST') {
                            $add=new processAddEmpForm();
                            $add->validate();
                            $add->addToDb();
                        }
                    }break





                    ;
                case 'lekarz': {
                        $form= new addDocForm($_SERVER['PHP_SELF'],'post');
                        $form->editForm($ident);
                        $form->display();
                        if($_SERVER['REQUEST_METHOD']=='POST') {
                            $add=new processAddDocForm();
                            $add->validate();
                            $add->addToDb();
                        }
                    } break





                    ;
                default:echo 'błąd';
                    break;
            }
        }else echo 'Brak użytkownika';
    }
//rola użytkownika w systemie na podstawie danych w bazie
    public function getUserMode($ident) {
        $db=new baseConfig();
        $query="SELECT nazwa \n"
                . "FROM mode,osoba \n"
                . "WHERE osoba.ident='$ident' AND osoba.mode=mode.id_mode";
        $zm=$db->getRes($query);
        $mode=mysql_fetch_row($zm);
        return $mode[0];
    }
//pobranie danych uzytkownika z bazy
    public function getUserData($ident) {
        $db=new baseConfig();

        $mode=$this->getUserMode($ident);
        if ($mode)
            switch ($mode) {
                case 'pacjent' :$query="SELECT * FROM osoba,pacjent where ident='$ident' AND osoba.id_osoba=pacjent.id_osoba";
                    break;
                case 'lekarz':$query="SELECT * FROM osoba,lekarz where ident='$ident' AND osoba.id_osoba=lekarz.id_osoba";
                    break;
                case 'admin':$query="SELECT * FROM osoba,pracownik where ident='$ident' AND osoba.id_osoba=pracownik.id_osoba";
                    break;
                case 'administrator':$query="SELECT * FROM osoba,pracownik where ident='$ident' AND osoba.id_osoba=pracownik.id_osoba";
                    break;
                case 'rejestracja':$query="SELECT * FROM osoba,pracownik where ident='$ident' AND osoba.id_osoba=pracownik.id_osoba";
                    break;
                default: return false;
            }
        else return false;

        $res=$db->getRes($query);
        return mysql_fetch_array($res);
    }


}
$mod=new modelUser();
if (isset($_GET['mode']))
    $mod->addUser($_GET['mode']);
if (isset($_GET['edit']))
    $mod->editUser('kamprz776178660');
// $user=$mod->getUserData('kamprz776178660');
?>

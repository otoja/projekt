
<?php

/**
 * Description of modelUser
 *
 * Klasa do obsługi danych użytkownika
 *
 * @author kama
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/forms/addPatientForm.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/forms/addEmpForm.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/forms/addDocForm.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/forms/addUrlopForm.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/baseConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/auth.php';

class modelUser {

    //dodawanie uzytkownika w zaleznosci od jego roli w systemie
    public function addUser($mode) {
        switch($mode) {
            case 'pacjent': {
                    $form=new addPatientForm('./engine/processAddPatientForm.php', 'post');
                    $form->display();
                }break
                ;
            case 'pracownik': {
                    $form=new addEmpForm('./engine/processAddEmpForm.php', 'post');
                    $form->display();
                }break
                ;
            case 'lekarz': {
                    $form= new addDocForm('./engine/processAddDocForm.php','post');
                    $form->display();
                }

        }
    }
//edycja danych użytkownika ze wskazanym identyfikatorem
    public function editUser($ident) {
//sprawdzanie kim jest użytkownik
        if(isset($_GET['act'])) {
            echo '<h2>Zweryfikuj dane pacjenta</h2>';
        }
        $mode=$this->getUserMode($ident);
        if ($mode) {
            switch($mode) {
                case 'pacjent': {
                        $form=new addPatientForm('./engine/processAddPatientForm.php?update', 'post');
                        $form->editForm($ident);
                        $form->display();
                        if ($_SERVER['REQUEST_METHOD']=='POST') {
                            $add=new processAddPatientForm();
                            $add->validate();
                            $add->addToDb();
                        }
                    }break
                    ;

                case 'lekarz': {
                        $form= new addDocForm('./engine/processAddDocForm.php?update','post');
                        $form->editForm($ident);
                        $form->display();
                        if($_SERVER['REQUEST_METHOD']=='POST') {
                            $add=new processAddDocForm();
                            $add->validate();
                            $add->addToDb();
                        }
                    } break
                    ;
                default: {
                        $form=new addEmpForm('./engine/processAddEmpForm.php?update', 'post');
                        $form->editForm($ident);
                        $form->display();
                        if ($_SERVER['REQUEST_METHOD']=='POST') {
                            $add=new processAddEmpForm();
                            $add->validate();
                            $add->addToDb();
                        }
                    }break
                    ;
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
    public function setUrlop($ident) {
        $user=$this->getUserMode($ident);
        if ($user!='pacjent') {

        }
    }
}
$mod=new modelUser();
if (isset($_GET['mode']))
    $mod->addUser($_GET['mode']);
if (isset($_GET['edit']))
    $mod->editUser('kamprz776178660');
// $user=$mod->getUserData('kamprz776178660');
?>

<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of modelUser
 *
 * @author kama
 */
require_once '../forms/addPatientForm.php';
require_once '../forms/addEmpForm.php';
require_once '../forms/addDocForm.php';
require_once '../engine/processAddEmpForm.php';
require_once '../engine/processAddPatientForm.php';
require_once '../engine/processAddDocForm.php';
require_once '../lib/baseConfig.php';

class modelUser {
//put your code here
    public function addUser($mode) {
        switch($mode) {
            case 'pacjent': {
                    $form=new addPatientForm($_SERVER['PHP_SELF'], 'post');
                    $form->display();
                    
                    if ($_SERVER['REQUEST_METHOD']=='POST') {
                        $add=new processAddPatientForm();
                        $add->validate();
                        $add->addToDb();
                        echo 'tu';
                    }
                }break;
            case 'pracownik': {
                    $form=new addEmpForm($_SERVER['PHP_SELF'], 'post');
                    $form->display();
                    if ($_SERVER['REQUEST_METHOD']=='POST') {
                        $add=new processAddEmpForm();
                        $add->validate();
                        $add->addToDb();
                    }
                }break;
            case 'lekarz': {
                    $form= new addDocForm($_SERVER['PHP_SELF'],'post');
                    $form->display();
                    if($_SERVER['REQUEST_METHOD']=='POST') {
                        $add=new processAddDocForm();
                        $add->validate();
                        $add->addToDb();
                    }
                }
            default: break;
        }
    }

    public function editUser($ident) {

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
                    }break;
                case 'lekarz': {
                        $form= new addDocForm($_SERVER['PHP_SELF'],'post');
                        $form->editForm($ident);
                        $form->display();
                        if($_SERVER['REQUEST_METHOD']=='POST') {
                            $add=new processAddDocForm();
                            $add->validate();
                            $add->addToDb();
                        }
                    } break;
                default:echo 'błąd'; break;
            }
        }else echo 'Brak użytkownika';
    }

    public function getUserMode($ident) {
        $db=new baseConfig();
        $query="SELECT nazwa \n"
                . "FROM mode,osoba \n"
                . "WHERE osoba.ident='$ident' AND osoba.mode=mode.id_mode";
        $zm=$db->getRes($query);
        $mode=mysql_fetch_row($zm);
        return $mode[0];
    }
}
$mod=new modelUser();
 //  echo $_GET['mode'];

   // $mod->addUser('pacjent');


$mod->editUser('kamprz776178660');

?>

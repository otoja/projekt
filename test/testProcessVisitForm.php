<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of testProcessVisitForm
 *
 * @author kama
 */
require_once '/usr/share/php/PHPUnit/Extensions/SeleniumTestCase.php';
class testProcessVisitForm extends PHPUnit_Extensions_SeleniumTestCase {
    //put your code here
    private $id;

    protected function setUp() {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://localhost/');
    }


    public function registerPatient() {
        $this->open('http://localhost/e-Przychodnia/index.php');
        $this->click('link=Zarejestruj');

        $this->type("dom=document.forms['form'].fname","test");
        $this->type("dom=document.forms['form'].lname","test");
        $this->type("dom=document.forms['form'].street","test");
        $this->type("dom=document.forms['form'].nr_d","10");
        $this->type("dom=document.forms['form'].nr_m","");
        $this->type("dom=document.forms['form'].city","test");
        $this->type("dom=document.forms['form'].kod","10-100");
        $this->type("dom=document.forms['form'].country","test");
        $this->type("dom=document.forms['form'].tel","2147483647");
        $this->type("dom=document.forms['form'].pesel","99999888333");
        $this->type("dom=document.forms['form'].nip","0000022000");
        $this->type("dom=document.forms['form'].mail","test@test.ts");
        $this->type("dom=document.forms['form'].pswd","test");
        $this->type("dom=document.forms['form'].rpswd","test");
        $this->select("dom=document.forms['form'].krew","A");
        $this->select("dom=document.forms['form'].rh","+");
        $this->select("dom=document.forms['form'].plec","Kobieta");
        $this->type("dom=document.forms['form'].ofname","test");
        $this->type("dom=document.forms['form'].olname","test");
        $this->type("dom=document.forms['form'].opesel","99999888333");
        $this->click("xpath=//form[@id='form']//input[@type='submit']");

        $query="SELECT count(*)FROM osoba as o,pacjent as p WHERE o.fname='test' AND o.lname='test' AND p.id_osoba=o.id_osoba";
        $link=mysql_connect('localhost', 'root', 'password');
        mysql_select_db('ePrzychodnia');
        $count=mysql_query($query);
        $count=mysql_fetch_array($count);
        if($count[0]==1) print_r("..dodano rekord do bazy");
        $query="SELECT count(*)FROM osoba as o,pacjent as p WHERE o.fname='test' AND o.lname='test' AND p.id_osoba=o.id_osoba";
        $link=mysql_connect('localhost', 'root', 'password');
        mysql_select_db('ePrzychodnia');
        $count=mysql_query($query);
        $count=mysql_fetch_array($count);
        if($count[0]==1) print_r("..dodano rekord do bazy");
    }

    public function loginPatient() {
        $link=mysql_connect('localhost', 'root', 'password');
        mysql_select_db('ePrzychodnia',$link) or die(mysql_error());
        $query="SELECT ident FROM osoba WHERE fname='test' AND lname='test'";
        $res=mysql_query($query);
        $res=mysql_fetch_array($res);
        $this->id=$res[0];
        $this->open('http://localhost/e-Przychodnia/index.php');
        $this->click('link=Zaloguj');
        // Fill out the form!
        $this->type("dom=document.forms['form'].ident", $this->id);
        $this->type("dom=document.forms['form'].login", 'test@test.ts');
        $this->type("dom=document.forms['form'].pswd", 'test');
        $this->click("xpath=//form[@id='form']//input[@type='submit']");
        $this->waitForPageToLoad(30000);
        $this->click('link=Terminarz');
        $this->click("xpath=//table[@id='lekarz']//input[@type='button']");
        $this->click("xpath=//table[@id='calendar']//tbody/tr[5]/td[4]/input[@type='button']");
        $this->click("xpath=//input[@value='Potwierdź']");
        $this->waitForExpression("Wiadomość została wysłana na adres test@test.ts");
        $this->click("link=Wyloguj");
    }
    public function testVisit() {
        $this->registerPatient();
        $this->loginPatient();
        $this->delete();
    }

    private function delete(){
        $link=mysql_connect('localhost', 'root', 'password');
        mysql_select_db('ePrzychodnia',$link) or die(mysql_error());
        $query="DELETE FROM umowione_wizyty WHERE pident='$this->id'";
        mysql_query($query) or die(mysql_error());
        $query="DELETE FROM osoba WHERE fname='test' AND lname='test'";
        mysql_query($query);
        $query="DELETE FROM pacjent WHERE ofname='test' AND olname='test'";
        mysql_query($query);

        unset($link);
        unset($query);
        unset($this->id);
    }
}
?>
$query
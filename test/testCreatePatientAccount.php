<?php
/* 
 * @author kama
*/
require_once '/usr/share/php/PHPUnit/Extensions/SeleniumTestCase.php';
require_once '../lib/baseConfig.php';
class testCreatePatientAccount  extends PHPUnit_Extensions_SeleniumTestCase {
    protected function setUp() {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://localhost/');
    }

    public function testRegisterFormExists() {
        printf('Test rejestracji nowego pacjenta:
            ...sprawdzanie istnienia formularza
            ');
        $this->open('http://localhost/e-Przychodnia/index.php');
        $this->click('link=Zarejestruj');
        $this->assertElementPresent("id=form") ;
        $this->assertElementPresent("dom=document.forms['form'].fname");
        $this->assertElementPresent("dom=document.forms['form'].lname");
        $this->assertElementPresent("dom=document.forms['form'].street");
        $this->assertElementPresent("dom=document.forms['form'].nr_d");
        $this->assertElementPresent("dom=document.forms['form'].nr_m");
        $this->assertElementPresent("dom=document.forms['form'].city");
        $this->assertElementPresent("dom=document.forms['form'].kod");
        $this->assertElementPresent("dom=document.forms['form'].country");
        $this->assertElementPresent("dom=document.forms['form'].tel");
        $this->assertElementPresent("dom=document.forms['form'].pesel");
        $this->assertElementPresent("dom=document.forms['form'].nip");
        $this->assertElementPresent("dom=document.forms['form'].mail");
        $this->assertElementPresent("dom=document.forms['form'].pswd");
        $this->assertElementPresent("dom=document.forms['form'].rpswd");
        $this->assertElementPresent("dom=document.forms['form'].krew");
        $this->assertElementPresent("dom=document.forms['form'].rh");
        $this->assertElementPresent("dom=document.forms['form'].plec");
        $this->assertElementPresent("dom=document.forms['form'].ofname");
        $this->assertElementPresent("dom=document.forms['form'].olname");
        $this->assertElementPresent("dom=document.forms['form'].opesel");
        $this->assertElementPresent("xpath=//form[@id='form']//input[@type='submit']");
    }

    public function testRegister() {
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
        if($count[0]==1) print_r("..dodano rekord do bazy");$query="SELECT count(*)FROM osoba as o,pacjent as p WHERE o.fname='test' AND o.lname='test' AND p.id_osoba=o.id_osoba";
        $link=mysql_connect('localhost', 'root', 'password');
        mysql_select_db('ePrzychodnia');
        $count=mysql_query($query);
        $count=mysql_fetch_array($count);
        if($count[0]==1) print_r("..dodano rekord do bazy");
        $this->deleteRecord();
    }

    public  function deleteRecord() {

        print_r('...kasowanie rekordu...');
        $db=new baseConfig();
        $query="DELETE FROM osoba WHERE fname='test' AND lname='test'";
        $del=$db->getRes($query);
        $query="DELETE FROM pacjent WHERE ofname='test' AND olname='test'";
        $res=$db->getRes($query);

        unset ($db);
        unset($res);
        unset ($del);


    }
    public function tearDown() {
         printf('Wykonany');
    }
}
?>

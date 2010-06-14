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
    private $id,$wiz;

    protected function setUp() {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://localhost/');
    }


    public function registerPatient() {
        print_r('-rejestracja pacjenta');
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
        $this->type("dom=document.forms['form'].nip","1000022001");
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
        $query="UPDATE osoba as o SET o.aktyw=1 WHERE o.fname='test' AND o.lname='test'";
        $link=mysql_connect('localhost', 'root', 'password');
        mysql_select_db('ePrzychodnia');
        mysql_query($query);
        
    }

    public function loginPatient() {
        print_r('
            -logowanie pacjenta');
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
    }

    public function loginRej() {
        print_r('-
            -logowanie rejestracja');
        $this->open('http://localhost/e-Przychodnia/index.php');
        $this->click('link=Zaloguj');
        $this->type("dom=document.forms['form'].ident", 'rejrej001206767');
        $this->type("dom=document.forms['form'].login", 'shagrin84@gmail.com');
        $this->type("dom=document.forms['form'].pswd", 'rejestr');
        $this->click("xpath=//form[@id='form']//input[@type='submit']");
        $this->waitForPageToLoad(30000);
        $this->assertTextPresent("*Witaj*");
    }
    public function loginDoc() {
        print_r('
            -logowanie lekarz');
        $this->open('http://localhost/e-Przychodnia/index.php');
//        $this->waitForPageToLoad(30000);
//        $this->refresh();
        $this->click('link=Zaloguj');
        $this->type("dom=document.forms['form'].ident", 'MarKos722518324');
        $this->type("dom=document.forms['form'].login", 'ma.kos@mail.pl');
        $this->type("dom=document.forms['form'].pswd", 'makos');
        $this->click("xpath=//form[@id='form']//input[@type='submit']");
        $this->waitForPageToLoad(30000);
        $this->assertTextPresent("*Witaj*");
    }
    public function newVisit() {
        print_r('
            -umawianie wizyty');
        $this->open('http://localhost/e-Przychodnia/index.php');
        $this->click('link=Terminarz');
        $this->click("xpath=//table[@id='lekarz']//tr[3]/td/input[@type='button']");
        $this->click("xpath=//table[@id='calendar']//tbody/tr[3]/td[2]/input[@type='button']");
        $this->click("xpath=//input[@value='Potwierdź']");
        $this->waitForExpression("Wiadomość została wysłana na adres test@test.ts");
        $this->click("link=Wyloguj");
    }
    public function activeVis() {
        print_r('
            -aktywacja wizyty');
        $this->open('http://localhost/e-Przychodnia/index.php');
        $this->click("link=Wszytskie wizyty");
        $this->click("xpath=//table//input[@type='button']");
        $this->assertElementPresent("dom=document.forms['form'].opis");
        $this->type("dom=document.forms['form'].opis","Opis wizyty");
        $this->click("xpath=//form[@id='form']//input[@type='submit']");
        $this->waitForPageToLoad(30000);
        $this->assertTextPresent('*Dodano wizytę do oczekujących*');
        $this->open('http://localhost/e-Przychodnia/index.php');
        $this->click("link=Wyloguj");
    }
    public function processVisit(){
        print_r('
            -przeprowadzenie wiyty');
        $this->open('http://localhost/e-Przychodnia/index.php');
        $this->click("link=Wizyty aktywne");
        $this->click("xpath=//table//input[@type='button']");
        $this->assertElementPresent("dom=document.forms['form'].objawy");
        $this->assertElementPresent("dom=document.forms['form'].doleg");
        $this->assertElementPresent("dom=document.forms['form'].badanie");
        $this->assertElementPresent("dom=document.forms['form'].rozpoznanie");
        $this->type("dom=document.forms['form'].objawy","Objawy");
        $this->type("dom=document.forms['form'].doleg","DOlegliwości");
        $this->type("dom=document.forms['form'].badanie","Badanie");
        $this->type("dom=document.forms['form'].rozpoznanie","89.00");
        $this->click("xpath=//form[@id='form']//input[@name='wyslij']");
        $this->waitForPageToLoad(30000);
        $this->click("link=Wyloguj");
    }
    public function checkVisit(){
        $link=mysql_connect('localhost', 'root', 'password');
        mysql_select_db('ePrzychodnia',$link) or die(mysql_error());
        $query="SELECT id_wiz FROM umowione_wizyty WHERE pident=$this->id";
        $res=mysql_query($query);
        $res=mysql_fetch_array($res);
        $wiz=$res[0];
        $query="SELECT count(*) FROM wizyta WHERE id_wizyta=$wiz";
        $res=mysql_query($query);
        $count=mysql_fetch_array($res);
        if ($count[0]>0)print_r('-
            wizyta została przeprowadzona');
        $this->wiz=$wiz;
    }
    public function testVisit() {
        $this->registerPatient();
        $this->loginPatient();
        $this->newVisit();
        $this->loginRej();
        $this->activeVis();
        $this->loginDoc();
        $this->processVisit();
        //$this->checkVisit();
        // $this->delete();
    }

    private function delete() {
        $link=mysql_connect('localhost', 'root', 'password'); $this->waitForPageToLoad(30000);
        $this->assertTextPresent("*Witaj*");
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
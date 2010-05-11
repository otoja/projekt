<?php

/**
 * Description of EmptyPHP
 *
 * @author kama
 */
require_once '/usr/share/php/PHPUnit/Extensions/SeleniumTestCase.php';
class createTestLoginForm extends PHPUnit_Extensions_SeleniumTestCase
{
    protected function setUp()
    {

        $this->setBrowser('*firefox'); // or *iexplore for IE
        $this->setBrowserUrl('http://localhost/');
    }

    public function testLoginFormExists()
    {
        $this->open('http://localhost/Final/forms/loginForm.php');

        $this->assertElementPresent("id=form");
        $this->assertElementPresent("dom=document.forms['form'].ident");
        $this->assertElementPresent("dom=document.forms['form'].login");
        $this->assertElementPresent("dom=document.forms['form'].pswd");
        $this->assertElementPresent("xpath=//form[@id='form']/input[@type='submit']");
    }

    public function testValidAuthentication()
    {
        $this->open('http://localhost/Final/forms/loginForm.php');

        // Fill out the form!
        $this->type("dom=document.forms['form'].ident", 'kamprz776178660');
        $this->type("dom=document.forms['form'].login", 'root@lkv.pl');
        $this->type("dom=document.forms['form'].pswd", 'kama');

        // Submit the form!
        $this->click("xpath=//form[@id='form']/input[@type='submit']");
        $this->waitForPageToLoad(30000); // 30 second default

        // Verify the login was successful
        
        $this->assertTextPresent('correct');

        // And that no Error is printed
        $this->assertTextNotPresent('*error*');
        echo 'wsio ok';
    }
}


?>
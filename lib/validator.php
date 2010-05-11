<?php

/**
 * Description of validator
 *
 * Klasa do walidacji formularzy
 *
 * @author kama
 */
define('e_alpha', 'Wyrażenie może zawierać tylko litery<br>');
define('e_alnum', 'Wyrażenie powinno zawierać litery i/lub cyfry<br>');
define('e_num', 'Wyrażenie powinno zawierać tylko cyfry<br>');
define('e_mail','Nieprawidłowy e-mail<br>');
define('e_date', 'Nieprawidłowy format daty<br>');
define('e_pcode','Nieprawidłowy kod pocztowy<br>');
define('e_pozw','Nieprawidłowy format pozwolenia<br>');
define('e_empty','Wypełnij wszystkie pola<br>');
define('e_dec','Nieodpowiedni format liczby<br>');

class validator {
    //put your code here
    public function isAlpha($obj) {
        if (preg_match("/[p{L}+A-Za-z]{2,}/",htmlspecialchars(trim($obj)))) return true;
        else $this->exc(e_alpha);
    }

    public function isAlnum($obj) {
        if (preg_match("/[p{L}+0-9A-Za-z*]/",htmlspecialchars(trim($obj)))) return true;
        else $this->exc(e_alnum);
    }

    public function isNum($obj) {
        if (preg_match("/[0-9]/",htmlspecialchars(trim($obj)))) return true;
        else $this->exc(e_num);
    }

    public function isEmail($obj) {
        if (preg_match("^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$^",htmlspecialchars(trim($obj)))) return true;
        else $this->exc(e_mail);
    }

    public function isDate($obj) {
        if (preg_match("/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}/",htmlspecialchars(trim($obj)))) return true;
        else $this->exc(e_date);
    }

    public function isPCode($obj) {
        if (preg_match('^[0-9]{2}-[0-9]{3}$^',htmlspecialchars(trim($obj)))) return true;
        else $this->exc(e_pcode);
    }

    public function isPozw($obj){
        if(preg_match('^[0-9]{2}/[0-9]{2,4}$^', htmlspecialchars(trim($obj)))) return true;
            else $this->exc(e_pozw);
    }

    public function isDec($obj){
        if(preg_match('^[0-9].[0-9]{0,2}$^', htmlspecialchars(trim($obj)))) return true;
            else $this->exc(e_dec);
    }
    public function exc($error) {
        throw new Exception($error);
    }
}
?>

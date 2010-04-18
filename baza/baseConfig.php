<?php
/**
 * Description of PHPClass
 *
 * Klasa obsługująca bazę danych
 *
 * @author kama
 */

class  baseConfig {
//put your code here
    private $db,$host,$link,$user,$pswd,$result,$id;
    //ustalenie parametrow bazy
    public function __construct() {
        $this->host = 'localhost';
        $this->user = 'root';
        $this->pswd = 'password';
        $this->db = 'ePrzychodnia';
    }
    //wybor bazy
    public function setDb($db) {
        $this->db=$db;
    }
    //polaczenie
    private function connect() {
        $this->link=mysql_connect($this->host, $this->user,$this->pswd) or die(mysql_error());
        mysql_select_db($this->db, $this->link) or die(mysql_error());
    }
    //wykonanie zapytania
    private function query($query) {
        $this->connect();
        if ($this->link) {
            mysql_query("SET NAMES 'utf8'",$this->link);
            $this->result=mysql_query($query, $this->link) or die(mysql_error());
            $this->id=mysql_insert_id($this->link);
        }
        $this->close();
    }
    //funkcja wykonujaca zapytanie i zwracajaca rezultat
    public function getRes($query){
        $this->query($query);
        if ($this->result) return $this->result;
    }
    //zamknieciepolaczenie z baza
    private function close() {
        mysql_close($this->link);
    }
    //ostatnie id wstawione do bazy
    public function getLastId() {
        return $this->id;
    }
}
?>

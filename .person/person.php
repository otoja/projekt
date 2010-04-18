<?php


/**
 * Description of person
 *
 * @author kama
 */
class person{
    
    protected $dane=array();
    public function  __construct($fname, $sname, $lname, $street, $fnr, $hnr, $post, $city, $country, $pesel) {
        $this ->dane ['fname']=$fname;
        $this->dane ['lname']=$lname;
        $this->dane ['sname']=$sname;
        $this->dane ['street']=$street;
        $this->dane ['fnr']=$fnr;
        $this->dane ['hnr']=$hnr;
        $this->dane ['post']=$post;
        $this->dane ['city']=$city;
        $this->dane ['country']=$country;
        $this->dane ['pesel']=$pesel;
        $this->dane ['mode']=0;
    }

    public function show(){
        echo implode(',', $this->dane);
    }
}
?>

<?php

/**
 * Description of processWorkinHsForm
 *
 * @author kama
 */
//stamp 30
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/validator.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/baseConfig.php';
class processWorkinHsForm{
    private $start_pn, $stop_pn, $start_wt, $stop_wt, $start_sr, $stop_sr, $start_czw, $stop_czw, $start_pt, $stop_pt,$min=16, $max=40;
    public function validate(){
        $val=new validator();
        try {
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                //poniedzialek
                if(isset($_POST['pon_h_s']) && !empty($_POST['pon_m_s']) && isset($_POST['pon_h_e']) && !empty($_POST['pon_m_e'])) {
                    if ($val->isNum($_POST['pon_h_s']) && $val->isNum($_POST['pon_m_s']) && $val->isNum($_POST['pon_h_e']) && $val->isNum($_POST['pon_m_e'])){
                        $s_stamp=((int)$_POST['pon_h_s'])*2;
                        $s_stamp+=(int)((int)$_POST['pon_m_s'])/30;
                        $this->start_pn=$s_stamp;
                        $s_stamp=((int)$_POST['pon_h_e'])*2;
                        $s_stamp+=(int)((int)$_POST['pon_m_e'])/30;
                        $this->stop_pn=$s_stamp;
                    }
                }else $val->exc(e_empty);
                //wtorek
                if(isset($_POST['wt_h_s']) && !empty($_POST['wt_m_s']) && isset($_POST['wt_h_e']) && !empty($_POST['wt_m_e'])) {
                    if ($val->isNum($_POST['wt_h_s']) && $val->isNum($_POST['wt_m_s']) && $val->isNum($_POST['wt_h_e']) && $val->isNum($_POST['wt_m_e'])){
                        $s_stamp=((int)$_POST['wt_h_s'])*2;
                        $s_stamp+=(int)((int)$_POST['wt_m_s'])/30;
                        $this->start_wt=$s_stamp;
                        $s_stamp=((int)$_POST['wt_h_e'])*2;
                        $s_stamp+=(int)((int)$_POST['wt_m_e'])/30;
                        $this->stop_wt=$s_stamp;
                    }
                }else $val->exc(e_empty);
                //sroda
                if(isset($_POST['sr_h_s']) && !empty($_POST['sr_m_s']) && isset($_POST['sr_h_e']) && !empty($_POST['sr_m_e'])) {
                    if ($val->isNum($_POST['sr_h_s']) && $val->isNum($_POST['sr_m_s']) && $val->isNum($_POST['sr_h_e']) && $val->isNum($_POST['sr_m_e'])){
                        $s_stamp=((int)$_POST['sr_h_s'])*2;
                        $s_stamp+=(int)((int)$_POST['sr_m_s'])/30;
                        $this->start_sr=$s_stamp;
                        $s_stamp=((int)$_POST['sr_h_e'])*2;
                        $s_stamp+=(int)((int)$_POST['sr_m_e'])/30;
                        $this->stop_sr=$s_stamp;
                    }
                }else $val->exc(e_empty);
                //czwartek
                if(isset($_POST['czw_h_s']) && !empty($_POST['czw_m_s']) && isset($_POST['czw_h_e']) && !empty($_POST['czw_m_e'])) {
                    if ($val->isNum($_POST['czw_h_s']) && $val->isNum($_POST['czw_m_s']) && $val->isNum($_POST['czw_h_e']) && $val->isNum($_POST['czw_m_e'])){
                        $s_stamp=((int)$_POST['czw_h_s'])*2;
                        $s_stamp+=(int)((int)$_POST['czw_m_s'])/30;
                        $this->start_czw=$s_stamp;
                        $s_stamp=((int)$_POST['czw_h_e'])*2;
                        $s_stamp+=(int)((int)$_POST['czw_m_e'])/30;
                        $this->stop_czw=$s_stamp;
                    }
                }else $val->exc(e_empty);
                //piatek
                if(isset($_POST['pt_h_s']) && !empty($_POST['pt_m_s']) && isset($_POST['pt_h_e']) && !empty($_POST['pt_m_e'])) {
                    if ($val->isNum($_POST['pt_h_s']) && $val->isNum($_POST['pt_m_s']) && $val->isNum($_POST['pt_h_e']) && $val->isNum($_POST['pt_m_e'])){
                        $s_stamp=((int)$_POST['pt_h_s'])*2;
                        $s_stamp+=(int)((int)$_POST['pt_m_s'])/30;
                        $this->start_pt=$s_stamp;
                        $s_stamp=((int)$_POST['pt_h_e'])*2;
                        $s_stamp+=(int)((int)$_POST['pt_m_e'])/30;
                        $this->stop_pt=$s_stamp;
                    }
                }else $val->exc(e_empty);
            }
        }catch(Exception $error) {
            echo '<font color="red">'.$error.'</font><br>';
            $this->error=1;
        }
    }
    public function addTodb(){
        $qry="UPDATE godziny_pracy SET start_stamp='$this->start_pn', end_stamp='$this->stop_pn' WHERE day=1";
        $qry2="UPDATE godziny_pracy SET start_stamp='$this->start_wt', end_stamp='$this->stop_wt' WHERE day=2";
        $qry3="UPDATE godziny_pracy SET start_stamp='$this->start_sr', end_stamp='$this->stop_sr' WHERE day=3";
        $qry4="UPDATE godziny_pracy SET start_stamp='$this->start_czw', end_stamp='$this->stop_czw' WHERE day=4";
        $qry5="UPDATE godziny_pracy SET start_stamp='$this->start_pt', end_stamp='$this->stop_pt' WHERE day=5";
        $db=new baseConfig();
        $res=$db->getRes($qry);
        if ($res)$res=$db->getRes($qry2);
        if ($res)$res=$db->getRes($qry3);
        if ($res)$res=$db->getRes($qry4);
        if ($res)$res=$db->getRes($qry5);
    }
}
$new=new processWorkinHsForm();
$new->validate();
$new->addTodb();
header('location: ../index.php');
?>

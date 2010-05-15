<?php

/**
 * Description of checkHours
 *
 * @author kama
 */
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/baseConfig.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/auth.php';
class checkHours {
    public function getWorkinHours() {
        $qry="SELECT * FROM godziny_pracy";
        $db=new baseConfig();
        $res=$db->getRes($qry);
        while($godz=mysql_fetch_assoc($res)) {
            $h[]=array('st'=>$godz['start_stamp'], 'end'=>$godz['end_stamp']);
        }
        return $h;
    }
    public function getDoctorHours($id) {
        $qry="SELECT * FROM godziny_pracy_lekarzy";
        $db=new baseConfig();
        $res=$db->getRes($qry);
        while($godz=mysql_fetch_assoc($res)) {
            $h[]=array('st'=>$godz['pn_st'], 'end'=>$godz['pn_end']);
            $h[]=array('st'=>$godz['wt_st'], 'end'=>$godz['wt_end']);
            $h[]=array('st'=>$godz['sr_st'], 'end'=>$godz['sr_end']);
            $h[]=array('st'=>$godz['czw_st'], 'end'=>$godz['czw_end']);
            $h[]=array('st'=>$godz['pt_st'], 'end'=>$godz['pt_end']);
        }
        return $h;
    }
    public function getAppoints($id) {
        $qry="SELECT start_stamp,data FROM umowione_wizyty WHERE id_lekarz='$id'";
        $db=new baseConfig();
        $res=$db->getRes($qry);
        $h=NULL;

        if ($res!=NULL) {
            while($wiz=mysql_fetch_assoc($res)) {
                $h[]=array('data'=>$wiz['data'], 'st'=>$wiz['start_stamp']);
            }
            return $h;
        }
    }
}
?>

<?php

/**
 * Description of data
 *
 * @author kama
 */
class dateOperation {
    public function changeDate($add,$date) {
        switch ($add) {
            case 'prevweek':
                $date = strtotime(date("Y-m-d", strtotime($date)) . " -1 week");
                return $date = date("Y-m-d",$date);
            case 'prevday':
                $date = strtotime(date("Y-m-d", strtotime($date)) . " -1 day");
                return $date = date("Y-m-d",$date);
            case 'nextday':
                $date = strtotime(date("Y-m-d", strtotime($date)) . " +1 day");
                return $date = date("Y-m-d",$date);
            case 'nextweek':
                $date = strtotime(date("Y-m-d", strtotime($date)) . " +1 week");
                return $date = date("Y-m-d",$date);
            default:
                break;
        }
    }

    public function poniedzialek($data) {
        $dzien = date("w",strtotime($data));
        if ($dzien!=1) {
            while(($dzien)>1) {
                $date = strtotime(date("Y-m-d", strtotime($data)) . " -1 day");
                $data = date("Y-m-d",$date);
                $dzien--;
            
//           $date = strtotime(date("Y-m-d", strtotime($data)) . " - 1 week");
//           $data = date("Y-m-d",$date);
            }return $data;
        }
        else return $data;
    }
    public function piatek($data) {
        $dzien =date("w",strtotime($data));
        $tmp=$data;
        if ($dzien!=5) {
            while($dzien<5) {
                $data = strtotime(date("Y-m-d", strtotime($data)) . " +1 day");
                $data = date("Y-m-d",$data);
                $dzien++;
            }return $data;

//             $data = strtotime(date("Y-m-d", strtotime($data)) . " + 1 week");
//            $data = date("Y-m-d",$data);
        }else return $data;
       
        
    }
}
?>

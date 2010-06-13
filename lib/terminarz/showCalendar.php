<html>
    <head>
        <script type="text/javascript" src="../../scripts/data.js"></script>
    </head>
</html>
<?php

/**
 * Description of showCalendar
 *
 * @author kama
 *
 * jesli wybrana godzina miesci sie w godzinie pracy przychodni- kolor empty
 * jesli do tego miesci sie w godzinach pracy lekarza- kolor free
 * jesli godzina jest na liscie wizyt wybranego dnia- kolor busy
 */

require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/baseConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/terminarz/dateOperation.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/terminarz/calendarStyle.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/terminarz/checkHours.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/auth.php';
$db=new baseConfig();
$dat=new dateOperation();
$calendar=new calendarStyle();
$hours=new checkHours();

if (isset($_GET['date'])) {
    $date=$_GET['date'];
}else $date=date("Y-m-d");

$dzien = date("w",strtotime($date));
$poniedzialek=$dat->poniedzialek($date);
$piatek=$dat->piatek($date);

if (isset($_GET['id'])) {
    $id=$_GET['id'];
}

if (isset($_GET['mode'])) {
    $add=$_GET['mode'];
    $date=$dat->changeDate($add,$date);
}
global $style_free, $style_busy,$style,$style_empty;
$style_free='style="background-color:#ffffcc"';
$style_busy='style="background-color:#ccccff"';
$style_empty='style="background-color: #ccff99"';
$calendar->topStyle($date,$id);

$godzPracyLek= $hours->getDoctorHours($id);
$wizyty=$hours->getAppoints($id, $date);
$godzPracyPrz=$hours->getWorkinHours();

$flaga=false;

for ($i=0; $i<25;$i++) {
    $h=(int)(($i+16)/2);
    $m=(int)(($i+16)%2*30);
    ($h<10)?$h='0'.$h:$h;
    ($m<10)?$m='0'.$m:$m;
    //pon
    if ($godzPracyPrz[0]['st']<=($i+16) && $godzPracyPrz[0]['end']>=($i+16)) {
        if ($godzPracyLek[0]['st']<=($i+16) && $godzPracyLek[0]['end']>=($i+16)) {
            foreach ($wizyty as $key=>$wiz) {
                if (!empty ($wiz) && (($i+16)==$wiz['st']) && (1==date("w",strtotime($wiz['data']))) && ($wiz['data']>=$poniedzialek && $wiz['data']<=$piatek))  $flaga=true;
            }if ($flaga)echo '<tr><td>'.$h.':'.$m.'</td><td '.$style_busy.'></td>';
            else echo'<tr><td>'.$h.':'.$m.'</td><td '.$style_free.' onclick="javascript:getData(\'./lib/terminarz/confirm.php?id='.$id.'&st='.($i+16).'&date='.$date.'&d=0\',\'cont\')"></td>';
            $flaga=false;
        }else echo '<tr><td>'.$h.':'.$m.'</td><td '.$style_empty.'></td>';
    }else echo '<tr><td>'.$h.':'.$m.'</td><td></td>';
    //wt
    if ($godzPracyPrz[1]['st']<=($i+16) && $godzPracyPrz[1]['end']>=($i+16)) {
        if ($godzPracyLek[1]['st']<=($i+16) && $godzPracyLek[1]['end']>=($i+16)) {
            foreach ($wizyty as $key=>$wiz) {
                if (!empty ($wiz) && (($i+16)==$wiz['st']) && (2==date("w",strtotime($wiz['data']))) && ($wiz['data']>=$poniedzialek && $wiz['data']<=$piatek))  $flaga=true;
            }if
            ($flaga)echo '<td '.$style_busy.'></td>';
            else echo'<td '.$style_free.' onclick="javascript:getData(\'./lib/terminarz/confirm.php?id='.$id.'&st='.($i+16).'&date='.$date.'&d=1\',\'cont\')"></td>';
            $flaga=false;
        }else echo '<td '.$style_empty.'></td>';
    }else echo '<td></td>';
    //sr
    if ($godzPracyPrz[2]['st']<=($i+16) && $godzPracyPrz[2]['end']>=($i+16)) {
        if ($godzPracyLek[2]['st']<=($i+16) && $godzPracyLek[2]['end']>=($i+16)) {
            foreach ($wizyty as $key=>$wiz) {
                if (!empty ($wiz) && (($i+16)==$wiz['st']) && (3==date("w",strtotime($wiz['data']))) && ($wiz['data']>=$poniedzialek && $wiz['data']<=$piatek))  $flaga=true;
            }if
            ($flaga)echo '<td '.$style_busy.'></td>';
            else echo'<td '.$style_free.' onclick="javascript:getData(\'./lib/terminarz/confirm.php?id='.$id.'&st='.($i+16).'&date='.$date.'&d=2\',\'cont\')"></td>';
            $flaga=false;
        }else echo '<td '.$style_empty.'></td>';
    }else echo '<td></td>';
    //czw
    if ($godzPracyPrz[3]['st']<=($i+16) && $godzPracyPrz[3]['end']>=($i+16)) {
        if ($godzPracyLek[3]['st']<=($i+16) && $godzPracyLek[3]['end']>=($i+16)) {
            foreach ($wizyty as $key=>$wiz) {
                if (!empty ($wiz) && (($i+16)==$wiz['st']) && (4==date("w",strtotime($wiz['data'])))  && ($wiz['data']>=$poniedzialek && $wiz['data']<=$piatek))  $flaga=true;
            }if
            ($flaga)echo '<td '.$style_busy.'></td>';
            else echo'<td '.$style_free.' onclick="javascript:getData(\'./lib/terminarz/confirm.php?id='.$id.'&st='.($i+16).'&date='.$date.'&d=3\',\'cont\')"></td>';
            $flaga=false;
        }else echo '<td '.$style_empty.'></td>';
    }else echo '<td></td>';
    //pt
    if ($godzPracyPrz[4]['st']<=($i+16) && $godzPracyPrz[4]['end']>=($i+16)) {
        if ($godzPracyLek[4]['st']<=($i+16) && $godzPracyLek[4]['end']>=($i+16)) {
            foreach ($wizyty as $key=>$wiz) {
                if (!empty ($wiz) && (($i+16)==$wiz['st']) && (5==date("w",strtotime($wiz['data']))) && ($wiz['data']>=$poniedzialek && $wiz['data']<=$piatek))  $flaga=true;
            }if
            ($flaga)echo '<td '.$style_busy.'></td></tr>';
            else echo'<td '.$style_free.' onclick="javascript:getData(\'./lib/terminarz/confirm.php?id='.$id.'&st='.($i+16).'&date='.$date.'&d=4\',\'cont\')"></td></tr>';
            $flaga=false;
        }else echo '<td '.$style_empty.'></td></tr>';
    }else echo '<td></td></tr>';
}
$calendar->bottomStyle('#ffffcc','#ccccff','#ccff99');


?>

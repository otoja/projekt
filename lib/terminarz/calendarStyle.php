<?php

/**
 * Description of style
 *
 * @author kama
 */

class calendarStyle {
    public function topStyle($date,$id) {
        $style='style="background-color: #6699ff; font-size: 15px; color: white;"';

        echo '<table id=calendar>
        <thead>
        <th></th><th></th><th></th><th>'.$date.'</th>
        <tr><td></td><td><input type="button" value="<< tydzień" onclick="javascript:getData(\'./lib/terminarz/showCalendar.php?mode=prevweek&date='.$date.'&id='.$id.'\',\'cont\')"/>
            </td><td></td><td></td><td></td>
            <td><input type="button" value="tydzień >>" onclick="javascript:getData(\'./lib/terminarz/showCalendar.php?mode=nextweek&date='.$date.'&id='.$id.'\',\'cont\')"/></td></tr>
        </tr>
        <tr>
        </td><td><td></td>
        <td><input type="button" value="<< dzień" onclick="javascript:getData(\'./lib/terminarz/showCalendar.php?mode=prevday&date='.$date.'&id='.$id.'\',\'cont\')"/></td>
        <td></td>
        <td><input type="button" value="dzień >>" onclick="javascript:getData(\'./lib/terminarz/showCalendar.php?mode=nextday&date='.$date.'&id='.$id.'\',\'cont\')"/></td>
         <td></td>
        </tr>';
        $dzien = date("w",strtotime($date));
        switch($dzien) {
            case 1 : echo '<td>Godzina</td><td '.$style.'>Poniedziałek<br></td><td>Wtorek</td><td>Środa<br></td><td>Czwartek</td><td>Piątek</td></tr>';
                break;
            case 2 : echo '<td>Godzina</td><td>Poniedziałek<br></td><td '.$style.'>Wtorek</td><td>Środa<br></td><td>Czwartek</td><td>Piątek</td></tr>';
                break;
            case 3 : echo '<td>Godzina</td><td>Poniedziałek<br></td><td>Wtorek</td><td '.$style.'>Środa<br></td><td>Czwartek</td><td>Piątek</td></tr>';
                break;
            case 4 : echo '<td>Godzina</td><td>Poniedziałek<br></td><td>Wtorek</td><td>Środa<br></td><td '.$style.'>Czwartek</td><td>Piątek</td></tr>';
                break;
            case 5 : echo '<td>Godzina</td><td>Poniedziałek<br></td><td>Wtorek</td><td>Środa<br></td><td>Czwartek</td><td '.$style.'>Piątek</td></tr>';
                break;
            default:echo '<td>Godzina</td><td>Poniedziałek<br></td><td>Wtorek</td><td>Środa<br></td><td>Czwartek</td><td>Piątek</td></tr>';
                break;
        }
        echo '</thead>
            <tbody>';
    }

    public function bottomStyle($free,$busy,$empty) {
        $style_free='style="background-color:'.$free.'"';
        $style_busy='style="background-color:'.$busy.'"';
        $style_empty='style="background-color:'.$empty.'"';
        echo '</tbody><tfoot><tr><td></td><td></td><td '.$style_busy.'>Zajęte</td><td '.$style_empty.'>Godziny pracy</td><td '.$style_free.'>Wolne</td><td></td></tr>
                </tfoot>
                </table>';
    }


}

?>

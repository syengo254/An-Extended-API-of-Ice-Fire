<?php
namespace App\Helpers;

class DateHelper {
    /**
     * calculate a characters age based on born and died properties
     * 
     */
    static function getCharacterAge(string $born, string $died) {
        $born = self::getIntFromStr($born);
        $died = self::getIntFromStr($died);

        // $born = (int) filter_var($born, FILTER_SANITIZE_NUMBER_INT);
        // $died = (int) filter_var($died, FILTER_SANITIZE_NUMBER_INT);

        $age = $died - $born;

        if($age && $age > 0){
            return $age;
        }

        return 0;
    }

    /**
     * convert something like "In 183 AC" to 183 as an integer
     * @param string
     * @return int
     */
    static function getIntFromStr(string $date){
        if($date == '' || $date == ' ') return 0;

        $endpos = strpos($date, ' AC');
        $startpos = 2;
        $len = $endpos - $startpos;
        
        $date = (int) substr($date, $startpos, $len);

        if($date > 0){
            return $date;
        }

        return 0;
    }
}
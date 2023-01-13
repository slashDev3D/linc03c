<?PHP
class Util {

    public static $dateToWeek = array('일', '월', '화', '수', '목', '금', '토');

    public function getYear(date $date) {
        if(isset($date) == false) {
            return false;
        }
        return date('Y', $date);
    }

    public function getMonth($date) {
        if(isset($date) == false) {
            return false;
        }
        return date('m', $date);
    }

    public function getDay($date) {
        if(isset($date) == false) {
            return false;
        }
        return date('d', $date);
    }

    public static function getDateToWeekTextArray() {
        return self::$dateToWeek;
    }

    // 시작요일
    public function getStartDayToWeek($date, $type = 'text') {
        $dateArray = explode('-', $date);
        
        // 요일관련부분을 text나 number로 뽑는곳
        if($type == 'text') {
            return self::$dateToWeek[date("w", mktime(0, 0, 0, $dateArray[1], 1, $dateArray[0]))]; 
        } else {
            return date("w", mktime(0, 0, 0, $dateArray[1], 1, $dateArray[0]));
        }
    }


    // 마지막요일
    public function getEndDayToWeek($date, $type = 'text') {
        $dateArray = explode('-', $date);

        // 요일관련부분을 text나 number로 뽑는곳
        if($type == 'text') {
            return $this->_dateToWeek[date("w", mktime(0, 0, 0, $dateArray[1], 1, $dateArray[0]))]; 
        } else {
            return date("w", mktime(0, 0, 0, $dateArray[1], date('t', strtotime($date)), $dateArray[0]));
        }
    }

    public static function dateDiff($startDate, $endDate, $token = 'd') {
        if(isset($startDate) == false || isset($endDate) == false) {
            return false;
        }

        $startDateTime = new DateTime($startDate);
        $endDateTIme = new DateTime($endDate);

        $interval = $startDateTime->diff($endDateTIme);

        switch($token) {
            case 'days':
                return $interval->days;
                break;
            case 'd' :
                return $interval->d;
                break;
            case 'm' :
                return $interval->m;
                break;
            case 'y' :
                return $interval->y;
                break;
            default :
                return false;
        }
    }

    public static function dateDiffArray($startDate, $endDate) {
        if(isset($startDate) == false || isset($endDate) == false) {
            return false;
        }

        $period = new DatePeriod(
             new DateTime($startDate),
             new DateInterval('P1D'),
             new DateTime($endDate)
        );

        return $period;
    }

    public static function arrayToHash (&$array, $name1, $name2 = '', $type = '') {

        $sorter=array();

        if(isset($array) == false) return false;
        if(isset($name1) == false) return false;
        if(isset($name2) == false) $name2 = $name1;
        if(isset($type) == false) return false;
        reset($array);

        switch($type) {
            case 'date':
                foreach($array as $key => $var) {
                    $date = self::dateDiffArray($var[$name1], $var[$name2]);
                    if($date->start->format('Y-m-d') == $date->end->format('Y-m-d')) {
                        if(is_array($sorter[$date->start->format('Y-m-d')]) == false) $sorter[$date->start->format('Y-m-d')] = array();
                        array_push($sorter[$date->start->format('Y-m-d')], $var);
                    } else {
                        foreach($date as $var2) {
                            if(isset($sorter[$var2->format('Y-m-d')]) == false) $sorter[$var2->format('Y-m-d')] = array();
                            array_push($sorter[$var2->format('Y-m-d')], $var);
                        }
                        if(isset($sorter[$date->end->format('Y-m-d')]) == false) $sorter[$date->end->format('Y-m-d')] = array();
                        array_push($sorter[$date->end->format('Y-m-d')], $var);
                    }

                }
                break;
            default:
                break;

        }
        
        $distinctSorter = array_unique($sorter);

//        foreach($distinctSorter as $key => $var) {
//            $ret[$var] = array();
//        }

        return $array=$sorter;
    }

}

?>
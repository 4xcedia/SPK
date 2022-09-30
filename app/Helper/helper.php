<?php 

if (!function_exists('format_decimal')) {
    /**
     * @param $number, $decimal 
     */
    function format_decimal($number, $decimal = 2) {
        if (is_numeric($number)) {
            return number_format($number, $decimal, "." ,",");
        } else {
            return number_format(0, $decimal, "." ,",");
        }
    }
}

if (!function_exists('date_formatted')) {
    function date_formatted($date,$format = null) {
        if($format){
            return date($format, strtotime($date));
        }
        return date('d-m-Y', strtotime($date));
    }
}
?>
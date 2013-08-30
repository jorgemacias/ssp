<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of funciones
 *
 * @author jorge
 */
class Funciones {
    //put your code here
    public function __construct() {
        ;
    }
    
    function formatear_fecha($date){
        
        $m=  explode('/', $date);

        $day = $m[0];
        $month = $m[1];
        $year = $m[2];

        return "$year-$month-$day";
    }
}

?>

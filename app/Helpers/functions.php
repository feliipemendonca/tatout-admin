<?php

use Carbon\Carbon;

function convertFloat($float) {
    return "R$ ".number_format($float,2,',','.');
}

function listDays() {
    return [
        'Domingo',
        'Segunda',
        'Terça',
        'Quarta',
        'Quinta',
        'Sexta',
        'Sábado'
    ];
}

function convertInFloat($float) {
    $float = str_replace("R$ ","", $float);
    $float = str_replace(".","", $float);
    $float = strtr($float, "," , ".");
    return $float = floatval($float);
}

function convertInDate($date) {
    return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'); 
}

function convertInTimeInt($int) {
    return intval(str_replace(':','', $int));
}

function convertTimeInHour($time) {
    $time =  str_split(strval($time));
    
    if(count($time) == 3)
        $time = '0'.$time[0].':'.$time[1].$time[2];
    else
        $time = $time[0].$time[1].':'.$time[2].$time[3];

    return $time;
}
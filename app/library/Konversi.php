<?php
/**
 * Created by PhpStorm.
 * User: rndmjck
 * Date: 28/07/18
 * Time: 16:41
 */



class Konversi
{
    public static function changeDateDayStyle($tanggal, $day)
    {
        $Data = explode("-", $tanggal);
        $Tahun = $Data[0];
        $D2 = $Data[1];
        if ($D2 == '01') {
            $Bulan = 'Januari';
        }
        if ($D2 == '02') {
            $Bulan = 'Februari';
        }
        if ($D2 == '03') {
            $Bulan = 'Maret';
        }
        if ($D2 == '04') {
            $Bulan = 'April';
        }
        if ($D2 == '05') {
            $Bulan = 'Mei';
        }
        if ($D2 == '06') {
            $Bulan = 'Juni';
        }
        if ($D2 == '07') {
            $Bulan = 'Juli';
        }
        if ($D2 == '08') {
            $Bulan = 'Agustus';
        }
        if ($D2 == '09') {
            $Bulan = 'September';
        }
        if ($D2 == '10') {
            $Bulan = 'Oktober';
        }
        if ($D2 == '11') {
            $Bulan = 'November';
        }
        if ($D2 == '12') {
            $Bulan = 'Desember';
        }
        $Hari = $Data[2];

        switch ($day) {
            case 'Sunday':
                $translateDay = 'Minggu';
                break;
            case 'Monday':
                $translateDay = 'Senin';
                break;
            case 'Tuesday':
                $translateDay = 'Selasa';
                break;
            case 'Wednesday':
                $translateDay = 'Rabu';
                break;
            case 'Thursday':
                $translateDay = 'Kamis';
                break;
            case 'Friday':
                $translateDay = 'Jumat';
                break;
            case 'Saturday':
                $translateDay = 'Sabtu';
                break;
        }


        return $translateDay.', '.$Hari . ' ' . $Bulan . ' ' . $Tahun;
    }
}
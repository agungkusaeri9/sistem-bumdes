<?php

use Carbon\Carbon;

function format_rupiah($angka)
{
    if (is_numeric($angka)) {
        if ($angka) {
            $hasil_rupiah = "Rp " . number_format($angka, 0, '.', '.');
        } else {
            $hasil_rupiah = 'Rp 0';
        }
    } else {
        $hasil_rupiah = 'Tidak Valid!';
    }
    return $hasil_rupiah;
}


function format_tanggal($tanggal, $format = 'd-m-Y')
{
    Carbon::setLocale('id');
    return Carbon::parse($tanggal)->format($format);
}


function getMonthName($monthNumber)
{
    $months = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    if ($monthNumber >= 1 && $monthNumber <= 12) {
        return $months[$monthNumber];
    } else {
        return 'Bulan tidak valid';
    }
}

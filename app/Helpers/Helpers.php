<?php


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


function format_tanggal($tanggal, $format = 'd-m-Y') {
    $timestamp = strtotime($tanggal);
    $tanggalFormatted = date($format, $timestamp);
    return $tanggalFormatted;
}

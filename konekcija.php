<?php
session_start();
$server_ime = 'localhost';
$korisnik_baze = 'root';
$baza_sifra = '';
$baza_ime = 'teretana_gdsi';

$konekt = mysqli_connect($server_ime, $korisnik_baze, $baza_sifra, $baza_ime);

if (!$konekt) {
    die("Neuspjesna konekcija!");
}
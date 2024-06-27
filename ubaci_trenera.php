<?php
ini_set('display_errors', 1);
include 'konekcija.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $trener_ime = $_POST['first_name'];
    $trener_prezime = $_POST['last_name'];
    $trener_email = $_POST['email'];
    $trener_telefon = $_POST['phone'];
    $trener_godine_iskustva = $_POST['years'];

    $sql = "INSERT into treneri(ime,prezime,email,broj_telefona,years_exp) values(?,?,?,?,?)";
    $run = $konekt->prepare($sql);
    $run -> bind_param("sssss",$trener_ime,$trener_prezime,$trener_email,$trener_telefon,$trener_godine_iskustva);
    $run->execute();

 $_SESSION['session_message'] = 'Stvorili ste trenera';
 header('location: administrator.php');
 exit();
}   
<?php
include 'f/fpdf.php';
ini_set('display_errors', 1);
include 'konekcija.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$trainer_id = 0;
$phone = $_POST['phone'];
$photo_path = $_POST['photo_path'];
$plan_id = $_POST['session_type'];

$sqlupit = "INSERT INTO clanovi(ime,prezime,email,broj_telefona,trainer_id,photo_path,plan_id) values (?,?,?,?,?,?,?)";
$pokreni = $konekt -> prepare($sqlupit);
$pokreni -> bind_param("ssssisi",$first_name,$last_name,$email,$phone,$trainer_id,$photo_path,$plan_id);
$pokreni -> execute();

$member_id = $konekt -> insert_id; // izvlacimo zapravo id (var_dump($konekt))
$pdf = new FPDF();
$pdf -> AddPage();
$pdf->SetFont('Arial','I',16);
$pdf->Cell(100,10,'Korisnicka Karta :');// pozicija polja na pdf tj teksta
$pdf->Ln(); // nova linija
$pdf->Cell(100,10, 'Ime:' . $first_name);
$pdf->Ln(); 
$pdf->Cell(100,10, 'Prezime:' . $last_name);
$pdf->Ln(); 
$pdf->Cell(100,10, 'Email :' . $email);
$pdf->Ln(); 
$pdf->Cell(100,10, 'Broj Telefona:' . $phone);

$file_name = 'access_cards/korisnik_' . $member_id . '.pdf';
$pdf->Output('F',$file_name);

$sqlupit2 =  "UPDATE clanovi SET access_card_pdf_file = ? WHERE clan_id = ?";
$run = $konekt->prepare($sqlupit2);
$run->bind_param("si", $file_name, $member_id);
$run->execute();


 $_SESSION['session_message'] = 'Stvorili ste korisnika teretane';
 header('location: administrator.php');
 exit();

}







 

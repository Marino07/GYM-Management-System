<?php
include 'konekcija.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo 'pre';
var_dump($_POST);
echo 'pre';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member_id = $_POST['member'];
    $trainer_id = $_POST['trainer'];
    $sql = "UPDATE clanovi SET trainer_id = ? WHERE clan_id = ?"; // Dodan točka-zarez nakon SQL upita
    $run = $konekt->prepare($sql);
    $run->bind_param("ii", $trainer_id, $member_id);
    $run->execute();

    $_SESSION['session_message'] = 'Dodjelili ste trenera';
    header("Location: administrator.php");
    exit();

}
?>

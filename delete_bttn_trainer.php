
<?php
include 'konekcija.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $trener_id = $_POST['trener_id'];
        $sql = "DELETE from treneri where trener_id = ?";
        $run = $konekt->prepare($sql);
        $run -> bind_param("i",$trener_id);
        $mesage = "";
        if($run->execute()){
            echo $message= "Clan uspjesno obrisan";
        }else {
            echo $mesage="Error";
        }
        $_SESSION['session_message'] = $message;
        header("location: administrator.php");
        exit;


    }
?>
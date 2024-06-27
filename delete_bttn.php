
<?php
include 'konekcija.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $clan_id = $_POST['member_id'];
        $sql = "DELETE from clanovi where clan_id = ?";
        $run = $konekt->prepare($sql);
        $run -> bind_param("i",$clan_id);
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

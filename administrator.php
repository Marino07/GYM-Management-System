<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'konekcija.php';
if(!isset($_SESSION['admin_id'])){
   header("Location: index.php");
   exit;
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Registracija Korisnika</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>


    <?php if(isset($_SESSION['session_message'])) : ?>
    <!-- Obavijest na vrhu stranice -->
    <div class="alert alert-success alert-dismissible fade show text-center mt-3" role="alert">
       <?php 
       echo $_SESSION['session_message'];
       unset($_SESSION['session_message']);  
       ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif;?>
    <div class="container mt-5">
    <div style="display: flex; justify-content: flex-end;">
    <a href="dodjeli_trenera.php" class="btn btn-dark" style="margin-bottom: 10px;">Dodjeli Trenera</a>
</div>
    <div class="row">
        <div class="col-md-12">
            <h2>Lista clanova</h2>
            <table class="table table-striped">
            <thead>
    <tr>
        <th>IME</th>
        <th>PREZIME</th>
        <th>Email</th>
        <th>Broj telefona</th>
        <th>Photo</th>
        <th>Trening plan</th>
        <th>Trener</th> 
        <th>Access Card</th>
        <th>Kreiran</th>
        <th>Akcije  </th>
    </tr>
</thead>

    <tbody>
        <?php
        $sql = "SELECT clanovi.* ,trening_plan.ime as trening_ime, treneri.ime as trener_ime,treneri.prezime as trener_prezime from clanovi
        LEFT JOIN trening_plan on clanovi.plan_id = trening_plan.plan_id
        LEFT JOIN treneri on clanovi.trainer_id = treneri.trener_id";
        $run = $konekt->query($sql);        
        $rez = $run->fetch_all(MYSQLI_ASSOC);
        $select_members = $rez;
        foreach ($rez as $result) : ?>
            <tr> 
                <td><?php echo $result['ime']; ?></td>
                <td><?php echo $result['prezime']; ?></td>
                <td><?php echo $result['email']; ?></td>
                <td><?php echo $result['broj_telefona']; ?></td>
                <td><img style ="width: 60px;"src="<?php echo $result['photo_path']; ?>"></td>
                <td><?php

                if($result['trening_ime']){
                    echo $result['trening_ime'];
                } else {echo "nema plana";}
                
                ?></td>
                <td><?php 
                if($result['trener_ime']){
                    echo $result['trener_ime'] . " " . $result['trener_prezime'];
                }else {echo "nema trenera";}

                 ?>
                <td><a target = "_blank" href = "<?php echo $result['access_card_pdf_file']; ?>">Access Card </a></td>
                <td><?php echo $result['created_at']; ?></td>
                <td>
                <form action="delete_bttn.php" method="POST">
    <input type="hidden" name="member_id" value="<?php echo $result['clan_id']?>">
    <button type="submit">DELETE</button>
</form>

            </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
</div>
</div>
<div class="container mt-5">
<div class="row">
<div class="col-md-12">
            <h2>Lista trenera</h2>
            <table class="table table-striped">
            <thead>
    <tr>
        <th>IME</th>
        <th>PREZIME</th>
        <th>Email</th>
        <th>Broj telefona</th> 
        <th>Godine iskustva</th>
        <th>Izbrisi</th>
    </tr>
</thead> 
<tbody>
    <?php
$sql = "SELECT * FROM treneri";
$run1 = $konekt->query($sql);
$res = $run1->fetch_all(MYSQLI_ASSOC);
$select_trainers = $res;

foreach($res as $rezultati) : ?>
<tr>
<td><?php echo $rezultati['ime']; ?></td>
<td><?php echo $rezultati['prezime']; ?></td>
<td><?php echo $rezultati['email']; ?></td>
<td><?php echo $rezultati['broj_telefona']; ?></td>
<td><?php echo $rezultati['years_exp']; ?></td>
<td>
<form action="delete_bttn_trainer.php" method="POST">
    <input type="hidden" name="trener_id" value="<?php echo $result['trener_id']?>">
    <button type="submit">DELETE</button>
</form>
</td>
<?php endforeach;?>
</tbody>
    </table>
</div>
</div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1 class="mb-4">Registracija Clanova</h1>
                <form action="ubaci_membera.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" name="first_name" required>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" name="last_name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="tel" class="form-control" name="phone" required>
                    </div>

                    <div class="form-group">
                        <label for="session_type">Odaberi tip sesije:</label>
                        <select class="form-control" name="session_type" required>
                            <?php
                            $sql = "SELECT * FROM trening_plan";
                            $run1 = $konekt->query($sql);
                            $res = $run1->fetch_all(MYSQLI_ASSOC);

                            foreach($res as $rezultati){
                                echo "<option value='" . $rezultati['plan_id'] . "'>" . $rezultati['ime'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <input type="hidden" name="photo_path" id="photoPathInputMember">
                    <div id="dropzone-upload-member" class="dropzone"></div>

                    <button type="submit" class="btn btn-primary">Registriraj se kao Member</button>
                </form>
            </div>

            <div class="col-md-6">
                <h1 class="mb-4">Registracija Trenera</h1>
                <form action="ubaci_trenera.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" name="first_name" required>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" name="last_name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="tel" class="form-control" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="years">GODINE ISKUSTVA:</label>
                        <input type="text" class="form-control" name="years" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Registriraj se kao Trener</button>
                    </form>



            </div>

        </div>
     
    </div>
   














    <!-- Bootstrap JS i jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <!-- Dodajte skriptu ispod vašeg HTML-a -->
    <script>
        // Inicijalizirajte Dropzone za Membera
        Dropzone.options.dropzoneUploadMember = {
            url: "upload_photo.php",
            paramName: "photo",
            maxFilesize: 20, // MB
            acceptedFiles: "image/*",
            init: function () {
                this.on("success", function (file, response) {
                    // Parse the JSON response
                    const jsonResponse = JSON.parse(response);
                    // Check if the file was uploaded successfully
                    if (jsonResponse.success) {
                        // Set the hidden input's value to the uploaded file's path
                        document.getElementById('photoPathInputMember').value = jsonResponse.photo_path;
                    } else {
                        console.error(jsonResponse.error);
                    }
                });
            }
        };
        // Inicijalizirajte Dropzone za Trenera
        Dropzone.options.dropzoneUploadTrainer = {
            url: "upload_photo.php",
            paramName: "photo",
            maxFilesize: 20, // MB
            acceptedFiles: "image/*",
            init: function () {
                this.on("success", function (file, response) {
                    // Parse the JSON response
                    const jsonResponse = JSON.parse(response);
                    // Check if the file was uploaded successfully
                    if (jsonResponse.success) {
                        // Set the hidden input's value to the uploaded file's path
                        document.getElementById('photoPathInputTrainer').value = jsonResponse.photo_path;
                    } else {
                        console.error(jsonResponse.error);
                    }
                });
            }
        };
    </script>
</body>
</html>

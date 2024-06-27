<?php
include 'konekcija.php';
 $sql = "SELECT * FROM clanovi";
 $run = $konekt->query($sql);       
 $rez = $run->fetch_all(MYSQLI_ASSOC);
 $select_members = $rez;


 $sqll = "SELECT * FROM treneri";
$run1 = $konekt->query($sqll);
$ress = $run1->fetch_all(MYSQLI_ASSOC);
$select_trainers = $ress;


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forma za dodelu trenera</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Stilizacija za centriranje forme */
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh; /* Visina ekrana */
    }
    /* Stilizacija za formu */
    .form-container {
      background-color: #f0f0f0;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      max-width: 500px;
      width: 100%;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="form-container">
    <h2 class="mb-4 text-center">Dodjela Trenera</h2>
    <form action="assign_trainer.php" method="POST">
      <div class="form-group">
        <label for="member">Izaberite Člana</label>
        <select name="member" id="member" class="form-control">
          <?php foreach ($select_members as $clan) : ?>
            <option value="<?php echo $clan['clan_id']; ?>">
              <?php echo $clan['ime'] . " " . $clan['prezime']; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      
      <div class="form-group">
        <label for="trainer">Izaberite Trenera</label>
        <select name="trainer" id="trainer" class="form-control">
          <?php foreach ($select_trainers as $trener) : ?>
            <option value="<?php echo $trener['trener_id']; ?>">
              <?php echo $trener['ime'] . " " . $trener['prezime']; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      
      <button type="submit" class="btn btn-primary btn-block mt-4">Dodjeli Trenera</button>
    </form>
  </div>
</div>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>



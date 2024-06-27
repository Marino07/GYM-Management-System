<!DOCTYPE html>
<html>

<head>
    <title>Teretana GDSI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="background"></div>
    <div class="content">
        <h1>Teretana GDSI</h1>
        <div class="buttons-container">
            <button class="button" onclick="redirectTo('administrator')">Administrator</button>
        </div>
    </div>

    <script>
        function redirectTo(role) {
             if (role === 'administrator') {
                window.location.href = 'prijava.php';
            
        }
      }
    </script>
</body>

</html>

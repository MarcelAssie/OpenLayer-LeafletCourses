<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Manrope:wght@200..800&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/today.css">
</head>
<body>
<?php
    echo "<div class='contenu'>";
    if (isset($error)) {
        echo "<p style='color:red;'><strong>{$error}</strong></p>";
    }
    echo "<div>
            <h2>Connectez-vous</h2>
            <form action='/login' method='POST'>
                <div class='mb-3 input-group'>
                    <span class='input-group-text'><i class='fas fa-envelope'></i></span>
                    <input type='email' class='form-control' name='email' placeholder='Votre email' aria-describedby='emailHelp'>
                </div>
                <div class='mb-3 input-group'>
                    <span class='input-group-text'><i class='fas fa-lock'></i></span>
                    <input type='password' class='form-control' name='password' placeholder='Votre mot de passe'>
                </div>
                <button type='submit' class='btn btn-primary w-100'>
                   Validez
                </button>
            </form>
          </div>
    </div>";
?>

</body>
</html>

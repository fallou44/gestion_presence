<?php
session_start();

$errorMessage = ""; // Variable pour stocker les messages d'erreur

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les champs sont vides
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $errorMessage = "Veuillez remplir tous les champs";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Lecture du fichier CSV
        $usersFile = fopen("/var/www/html/projet_new/data/Auth/users.csv", "r");
        $isAuthenticated = false;

        while (($userData = fgetcsv($usersFile)) !== FALSE) {
            if ($userData[1] === $email && $userData[2] === $password) {
                $_SESSION['user'] = $userData;
                $isAuthenticated = true;
                break;
            }
        }

        fclose($usersFile);

        if ($isAuthenticated) {
            // Redirection en fonction du rôle
            if ($_SESSION['user'][3] === "Apprenant") {
                header("Location: /presence"); // Redirection vers la page de présence
                exit();
            } elseif ($_SESSION['user'][3] === "Administrateur") {
                header("Location: /referentiel"); // Redirection vers le tableau de bord
                exit();
            }
        } else {
            $errorMessage = "Email ou mot de passe incorrect";
        }
    }
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="/public/css/login.css">
<div class="logo">
  <img src="../public/images/sonatel.png" style="height: 60px; width: 129px;" alt="Logo_sonatel">
</div>
<div class="login-form">
   <?php
   if (!empty($errorMessage)) {
       echo "<h5 style='color: red;'>$errorMessage</h5>";
   }
   ?>
   <form method="POST" action="" >
  <div class="form-group" style="margin-top: 50px;">
    <label for="email">Email Address <span>*</span></label>
    <input type="text" id="email" name="email" placeholder="Enter email Address*" required>
    <?php if(isset($emailError)) echo "<span>$emailError</span>"; ?>
  </div>
  <div class="form-group" style="margin-top: 20px;" >
    <label for="password">Password <span>*</span></label>
    <div class="password-input-container">
      <input style="width: 89%;" type="text" id="password" name="password" placeholder="Enter your password*" required>
      <button style="display: flex; width: 10%; margin-top: 1% ; border: 1px solid #67b7af; float: right;" type="button" id="toggle-password">
      <i class="fa-solid fa-eye" style="color: #E8E9E9;"></i> <!-- Icône d'œil pour afficher le mot de passe -->
      </button>
      <?php if(isset($passwordError)) echo "<span>$passwordError</span>"; ?>
    </div>
  </div>
  <div class="form-group-checkbox">
    <div>
      <input type="checkbox" id="remember-me" name="remember-me" style="accent-color: #67b7af;">
      <label for="remember-me">Remember me</label>
    </div>
    <a href="#">Mot de passe Oublié?</a>
  </div>
  <div class="form-group">
    <button type="submit">Log in</button>
  </div>
  </form> <!-- Fin du formulaire -->
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('toggle-password');

    togglePasswordButton.addEventListener('click', function() {
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        togglePasswordButton.innerHTML ='<i class="fa-solid fa-eye" style="color: #E8E9E9;"></i>'; // Remplacer le texte par l'icône
      } else {
        passwordInput.type = 'password';
        togglePasswordButton.innerHTML ='<i class="fa-solid fa-eye-slash"></i>'; // Remplacer le texte par l'icône
      }
    });
  });
</script>

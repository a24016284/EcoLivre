<?php
// Démarrer la session. C'est essentiel pour "se souvenir" que l'utilisateur est connecté.
session_start();

// 1. Définir des identifiants valides (pour l'exemple SANS base de données)
$valid_username = "Moi";
$valid_password = "AMU";

// 2. Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupérer les données du formulaire
    // htmlspecialchars() aide à prévenir les attaques XSS
    $input_username = htmlspecialchars($_POST['username']);
    $input_password = htmlspecialchars($_POST['password']);

    // 3. Vérifier les identifiants
    if ($input_username === $valid_username && $input_password === $valid_password) {
        
        // --- CONNEXION RÉUSSIE ---
        
        // 4. Enregistrer l'état de la connexion dans la session
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['username'] = $input_username; // Stocket le nom d'utilisateur pour l'utiliser plus tard

        // 5. Rediriger l'utilisateur vers une page de bienvenue (par exemple, dashboard.php)
        header("Location: index.php");
        exit; // Toujours appeler exit après une redirection

    } else {
        
        // --- ÉCHEC DE LA CONNEXION ---
        
        // 6. Afficher un message d'erreur et rediriger vers la page de connexion (ou afficher le message ici)
        echo "Nom d'utilisateur ou mot de passe incorrect. <a href='login.html'>Réessayer</a>";
        
        // Vous pouvez aussi rediriger vers la page de connexion avec un message d'erreur :
        // header("Location: login.html?error=invalid");
        // exit;

    }
} else {
    // Si quelqu'un essaie d'accéder directement à ce script, on le renvoie au formulaire.
    header("Location: login.html");
    exit;
}
?>
<?php
// Demander à PHP de gérer la session d'utilisation
session_start();

// Vérifier s'il y a un paramètre d'URL dans la requête
if(isset($_GET['action']) && $_GET['action'] == 'lo') {
    // Détruire la variable de session 'util'
    unset($_SESSION['util']);
}

// 2) Si le formulaire est soumit
if(isset($_POST['courriel'])) {
    // 3) Récupérer la saisie de l'utilisateur
    $courriel = $_POST['courriel'];
    $mdp = $_POST['mdp'];

    // 4) Lire l'info sur TOUS les utilisateurs dans le fichier JSON
    $utilsTexte = file_get_contents('data/utilisateurs.json');
    $utilsTab = json_decode($utilsTexte, true);
    //print_r($utilsTab);

    // 5) Tester s'il y a un utilisateur ayant l'adresse de courriel donnée 
    // et si les mots de passe coincident
    if(isset($utilsTab[$courriel]) 
            && $utilsTab[$courriel]['mdp'] == hash('sha512', $mdp)) {
        // Tester si cet utilisateur a donné le bon mot de passe
        // Conserver cette information dans la session d'utilisateur
        $_SESSION['util'] = $courriel;
    }
    else {
        $erreurConnexion = true;
    }
}

// Langues disponibles
$languesDisponibles = [];
$nomsDesLangues = [];
$contenuDossierTextes = scandir('textes');
foreach($contenuDossierTextes as $nomDossier) {
  if($nomDossier != '.' && $nomDossier != '..') {
    $codeEtNomLangue = explode('-', $nomDossier);
    $languesDisponibles[] = $codeEtNomLangue[0];
    $nomsDesLangues[$codeEtNomLangue[0]] = $codeEtNomLangue[1];
  }
}

// i18n
// A - Déterminer la langue par défaut
$langueChoisie = 'fr';

// B - Vérifier si l'utilisateur a déjà fait un choix de langue auparavant.
// Si tel est le cas, le tableau $_CCOKIE contiendra un témoin HTTP nommé 
// 'simfolio_langue' (voir le code de l'étape C plus loin)
if(isset($_COOKIE['simfolio_langue']) && in_array($_COOKIE['simfolio_langue'], $languesDisponibles)) {
  $langueChoisie = $_COOKIE['simfolio_langue'];
}

// C - Si l'utilisateur choisi une langue en cliquant un lien dans la navigation en haut de la page
if(isset($_GET['langue']) && in_array($_GET['langue'], $languesDisponibles)) {
  $langueChoisie = $_GET['langue'];
  
  // C2 - Retenir le choix de langue de l'utilisateur dans un témoin HTTP (cookie)
  setcookie('simfolio_langue', $langueChoisie, time() + 365*24*60*60*2); // expire dans 2 ans
}

// D - On est enfin prêt à charger le fichier contenant les textes dans langue choisie
include('textes/' . $langueChoisie . '-' . $nomsDesLangues[$langueChoisie] . '/i18n.txt.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="images/lynx-64.png">
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:300,700|Roboto:700,400' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/styles.css">
    <title><?= $meta[$page]['titre']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $meta[$page]['desc']; ?>">
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php" title="<?= $titreLienAccueil; ?>"><img src="images/lynx-64.png" alt="Lynx" class="logo"></a>
            <h1 class="logo">Lynx</h1>
        </div>
        <nav>
          <a href="compte.php" class="<?php if($page=='compte') { echo 'actif'; } ?>"><?= $lienMonCompte; ?>
            <?php if(isset($_SESSION['util'])):  ?>
                <i><?= $_SESSION['util']; ?></i>
                <a href="compte.php?action=lo">Déconnexion</a>
            <?php endif; ?>
          </a>
            
        </nav>
    </header>
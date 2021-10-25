<?php
    if(isset($_POST['courriel'])) {
        // Tests :
        // echo 'Formulaire soumit avec info suivante : ';
        // echo '<br>';
        // echo $_POST['courriel'];
        // echo '<br>';
        // echo $_POST['mdp'];
        
        // 1) Récupérer la saisie de l'utilisateur
        $courriel = $_POST['courriel'];
        $mdp = $_POST['mdp'];

        // 2) Variable qui détermine si l'utilisateur est connecté ou pas
        $utilConnecte = false;

        // 3) Lire l'info sur TOUS les utilisateurs dans le fichier JSON
        $utilsTexte = file_get_contents('data/utilisateurs.json');
        $utilsTab = json_decode($utilsTexte, true);
        //print_r($utilsTab);

        // 4) Tester s'il y a un utilisateur ayant l'adresse de courriel donnée 
        if(isset($utilsTab[$courriel])) {
            // Tester si cet utilisateur a donné le bon mot de passe
            $mdpEnc = $utilsTab[$courriel]['mdp'];
            if($mdpEnc == hash('sha512', $mdp)) {
                $utilConnecte = true;
                echo "On est logué !!!!!";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="images/lynx-64.png">
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:300,700|Roboto:700,400' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/styles.css">
    <title>Mon compte | Lynx</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mon compte Lynx permet la gestion des avoirs et obligations, incluants les espèces, les comptes d'investissements, les avoirs immobiliers, et les cryptomonnaies.">
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php" title="Page d'accueil"><img src="images/lynx-64.png" alt="Lynx" class="logo"></a>
            <h1 class="logo">Lynx</h1>
        </div>
        <nav>
            <a href="compte.php" class="actif">Mon compte</a>
            <a href="#">À propos</a>
        </nav>
    </header>
    <section class="principale">
        <form action="compte.php" method="post">
            <fieldset>
                <legend>Connexion à Lynx</legend>
                <input type="text" name="courriel" placeholder="Adresse courriel">
                <input type="password" name="mdp" id="mdp" placeholder="Mot de passe">
                <input type="submit" value="Se connecter">
            </fieldset>
            <div class="actions-compte">
                <a href="#">Mot de passe oublié ?</a>
                <a href="#">Nouveau compte</a>
            </div>
        </form>
    </section>
    <footer>
        <div class="da">&copy;2021 Lynx. Tous droits réservés.</div>
        <nav class="navigation-secondaire">
            <a href="#" title="À venir">Politique de confidentialité</a>
            <a href="#" title="À venir">Conditions d'utilisation</a>
            <a href="" title="" class="actif">FR</a>
            <a href="" title="" class="">EN</a>
        </nav>
    </footer>
</body>
</html>
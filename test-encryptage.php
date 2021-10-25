<?php
    // Mot de passe en texte clair
    $mdp = "test";

    // Mot de passe encrypté avec l'algorithme de hachage SHA512
    $mdpEncrypte = hash("sha512", $mdp);

    echo "Le mot de passe encrypté est : $mdpEncrypte et il est de longueur : ".strlen($mdpEncrypte);
?>
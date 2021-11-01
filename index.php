<?php
    $page = 'accueil';
    include('inclusions/entete.php');
?>
    <section class="principale">
        <div>
            <h1><?= $amorce; ?></h1>
            <h3><?= $sousTitre; ?></h3>
            <ul>
                <li><?= $liste1; ?></li>
                <li><?= $liste2; ?></li>
                <li><?= $liste3; ?></li>
            </ul>
        </div>
        <div>
            <img src="images/accueil.jpg" alt="">
        </div>
    </section>
<?php
    include('inclusions/pied2page.php')
?>
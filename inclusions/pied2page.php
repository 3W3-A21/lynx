    <footer>
        <div class="da">&copy;2021 Lynx. <?= $droits; ?></div>
        <nav class="navigation-secondaire">
            <a href="#" title="<?= $titreAVenir; ?>"><?= $lienConfidentialite; ?></a>
            <a href="#" title="<?= $titreAVenir; ?>"><?= $lienConditions; ?></a>
            <?php foreach($languesDisponibles as $codeLangue) {  ?>
                <a href="?langue=<?= $codeLangue; ?>" class="<?php if($langueChoisie == $codeLangue) {echo 'actif';} ?>" title="<?= ucfirst($nomsDesLangues[$codeLangue]); ?>"><?= strtoupper($codeLangue); ?></a>
            <?php } ?>
        </nav>
    </footer>
</body>
</html>
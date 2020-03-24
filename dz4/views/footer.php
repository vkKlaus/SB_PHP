<footer>
    <ul class="vertical-menu">
        <?php
        foreach ($mainMenu as $element) { ?>
            <li>
                <a href="<?= $element['path'] ?>" class="vertical-menu-link">
                    <div class="vertical-menu-element">
                        <?= (mb_strlen($element['title']) <= 15 ?
                            $element['title'] :
                            mb_substr($element['title'], 0, 12) . '...') ?>
                    </div>
                </a>
            </li>
        <?php } ?>
    </ul>
    <div class="copy-right">&copy;&nbsp;<nobr>2018</nobr> Project.</div>
</footer>
</body>

</html>
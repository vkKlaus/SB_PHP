
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/db/main_menu.php';

    function cmp($a, $b)
    {
        if ($a['sort'] == $b['sort']) {
            return 0;
        }
        return ($a['sort'] < $b['sort']) ? -1 : 1;
    }

    uasort($mainMenu, 'cmp');

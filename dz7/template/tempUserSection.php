<div>
    <?php

    function outTree($parent_id, $level)
    {
        global $category, $linkSections;
        if (isset($category[$parent_id])) {
            // -----------------------------------------------------------------
            echo "<ul class=\"section-list\">";
            $uri = $_SERVER["REQUEST_URI"];
            // -----------------------------------------------------------------
            foreach ($category[$parent_id] as $value) {

                $color = "rgb(" . $value["red"] . "," . $value["green"] . "," . $value["blue"] . ")";
                // -----------------------------------------------------------------
                echo '<li> 
                    <a href="' . $linkSections . '?parent=' . $value['sections_id'] . '&parentName=' . str_replace(" ", "%20", $value['name']) . '" style=" color:' . $color . '; 
                                border-bottom: ' .
                    ($value['email'] == $_SESSION['login'] ?
                        ' 3px solid ' . $color
                        : 'none') .
                    '" >' .
                    $value['name'] .
                    '</a>
                </li>';
                // -----------------------------------------------------------------
                $level = $level + 1;

                outTree($value["sections_id"], $level);

                $level = $level - 1;
            }
            // -----------------------------------------------------------------
            echo "</ul>";
            // -----------------------------------------------------------------
        }
    }


    outTree(0, 0);
    ?>
    <br>
    <p>* выделенные подчеркиванием разделы созданы текущим пользователем</p>

</div>
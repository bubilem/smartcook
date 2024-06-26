<aside>
    <h2>Links</h2>
    <nav>
        <a href="">Home page</a>
        <a href="https://github.com/bubilem/smartcook">Project Documentation</a>
        <a href="https://github.com/bubilem/smartcook/tree/main/docs/api">API - Documentation</a>
        <a href="https://www.smartcook-project.eu/api">API - Application</a>
        <a href="https://www.smartcook-project.eu/catalog">CLIENT - Catalog</a>
        <a href="https://www.smartcook-project.eu/todays-table/">CLIENT - Today's Table</a>
        <a href="https://www.smartcook-project.eu/form/">CLIENT - Form</a>
        <a href="https://www.smartcook-project.eu/guess-the-recipe/">CLIENT - Guess the Recipe Game</a>
        <a href="https://www.smartcook-project.eu/recipe-by-ingredients/">CLIENT - Recipe by ingredients</a>
        <a href="https://www.skolavdf.cz">VOŠ, SPŠ a SOŠ Varnsdorf</a>
    </nav>
    <?php
    if ($page["url"] != "home") {
        echo "<h2>Articles</h2>";
        echo "<nav>";
        $pages = [];
        foreach (scandir('pages') as $dir) {
            if ($dir == '.' || $dir == '..') {
                continue;
            }
            if (!file_exists('pages/' . $dir . '/data.json')) {
                continue;
            }
            $data = json_decode(file_get_contents('pages/' . $dir . '/data.json'), true);
            if ($data["type"] == "article") {
                $pages[$data["date"] . '-' . $data["url"]] = $data;
            }
        }
        krsort($pages);
        foreach ($pages as $p) {
            echo '<a href="?p=' . $p["url"] . '" title="' . $p['description'] . '">' . $p["title"] . '</a>';
        }

        echo "</nav>";
    }
    ?>

</aside>
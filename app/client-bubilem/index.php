<?php
/*
 * SmartCook klient
 * 
 * Vytvoří webovou stránku, do které se generují recepty pomocí komunikace s API.
 * Recepty se do stránky vkádají dynamicky pomocí JS.
 * Pro jednotlivé stráky a jejich části jsou vytvořeny šablony (view)
 * 
 */

require_once __DIR__ . "/conf.php";
require_once __DIR__ . "/app/Template.php";

echo (
    new Template(
        "view/page.html",
        [
            'base' => BASE,
            'get_url' => BASE . 'get/',
            'recipe-filter' => file_get_contents("view/recipe-filter.html"),
            'datetime' => date("d. m. Y"),
        ]
    )
)->render();
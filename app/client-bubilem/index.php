<?php
/*
 * SmartCook klient
 * 
 * Vytvoří webovou stránku, do které se generují recepty pomocí komunikace s API.
 * Recepty se do stránky vkádají dynamicky pomocí JS.
 * Pro jednotlivé stráky a jejich části jsou vytvořeny šablony (view)
 * 
 */

require_once "app/Template.php";
echo (
    new Template(
        "view/page.html",
        [
            'nav-recipe-category' => file_get_contents("view/nav-recipe-category.html"),
            'datetime' => date("d. m. Y"),
        ]
    )
)->render();
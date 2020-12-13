<?php

/**
 * Vstupni bod webove aplikace.
 */
class ApplicationStart {

    /**
     * Inicializace webove aplikace.
     */
    public function __construct()
    {
        // nactu rozhrani kontroleru
        require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");
    }

    /**
     * Spusteni webove aplikace.
     */
    public function appStart(){

        $page = explode("/",$_GET["page"])[0];
        //// test, zda je v URL pozadavku uvedena dostupna stranka, jinak volba defaultni stranky
        // mam spravnou hodnotu na vstupu nebo nastavim defaultni
        if(isset($page) && array_key_exists($page, WEB_PAGES)){
            $pageKey = $page; // nastavim pozadovane
        } else {
            $pageKey = DEFAULT_WEB_PAGE_KEY; // defaulti klic
        }
        // pripravim si data ovladace
        $pageInfo = WEB_PAGES[$pageKey];

        //// nacteni odpovidajiciho kontroleru, jeho zavolani a vypsani vysledku
        // pripojim souboru ovladace
        require_once(DIRECTORY_CONTROLLERS ."/". $pageInfo["file_name"]);

        // nactu ovladac a bez ohledu na prislusnou tridu ho typuju na dane rozhrani
        /** @var IController $controller  Ovladac prislusne stranky. */
        $controller = new $pageInfo["class_name"];
        // zavolam prislusny ovladac a vypisu jeho obsah
        echo $controller->show($pageInfo["title"]);

    }
}

?>


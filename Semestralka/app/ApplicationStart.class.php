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

        if(isset($_GET['page'])){
            $page = explode("/",$_GET["page"])[0];
            if(array_key_exists($page, WEB_PAGES)){
                $pageKey = $page;
            }else{
                $pageKey = DEFAULT_WEB_PAGE_KEY;
            }
        }
        else{
            $pageKey = DEFAULT_WEB_PAGE_KEY;
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


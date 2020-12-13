<?php
// nactu rozhrani kontroleru
require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

class ReviewsController implements IController
{

    /** @var DatabaseModel $db  Sprava databaze. */
    private $db;

    /**
     * Inicializace pripojeni k databazi.
     */
    public function __construct() {
        // inicializace prace s DB
        require_once (DIRECTORY_MODELS ."/DatabaseModel.class.php");
        $this->db = new DatabaseModel();
    }

    /**
     * Vrati obsah stranky se seznamem rek
     * @param string $pageTitle     Nazev stranky.
     * @return string               Vypis v sablone.
     */
    public function show(string $pageTitle):string {
        //// vsechna data sablony budou globalni
        global $tplData;
        $tplData = [];
        // nazev
        $tplData['title'] = $pageTitle;

        $id = explode("/",$_GET["page"])[1];

        $tplData['vypis'] = $this->db->getReviewByRiver($id);

        /*if(isset($_POST['action']) and $_POST['action'] == "vypis"
            and isset($_POST['id_REKA'])
        ){

            $tplData['vypis'] = $this->db->getReviewByRiver(intval($_POST['id_REKA']));
        }


        if(isset($_POST['action']) and $_POST['action'] == "vypisAll"){
            // provedu smazani uzivatele
            $tplData['vypisAll'] = $this->db->getAllReviewsRivers();
        }*/

        //// vypsani prislusne sablony
        // zapnu output buffer pro odchyceni vypisu sablony
        ob_start();
        // pripojim sablonu, cimz ji i vykonam
        require(DIRECTORY_VIEWS ."/ReviewsTemplate.tpl.php");
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
}
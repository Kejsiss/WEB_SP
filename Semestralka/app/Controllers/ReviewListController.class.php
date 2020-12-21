<?php
// nactu rozhrani kontroleru
require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

/**
 * Kontroller se stara o vypis recenzi uzivatele
 * @author Kment
 * Class ReviewListController
 */
class ReviewListController implements IController
{

    /** @var DatabaseModel $db  Sprava databaze. */
    private $db;
    private $um;

    /**
     * Inicializace pripojeni k databazi.
     */
    public function __construct() {
        // inicializace prace s DB
        require_once (DIRECTORY_MODELS ."/DatabaseModel.class.php");
        require_once (DIRECTORY_MODELS ."/UserModel.class.php");
        require_once("MySessions.class.php");
        $this->um= new UserModel();
        $this->db= new DatabaseModel();
    }

    /**
     * Vrati obsah stranky
     * @param string $pageTitle     Nazev stranky.
     * @return string               Vypis v sablone.
     */
    public function show(string $pageTitle):string {
        //// vsechna data sablony budou globalni
        global $tplData;
        $tplData = [];
        // nazev
        $tplData['title'] = $pageTitle;


        if(isset($_POST['action']) and $_POST['action'] == "deleteRiverReview"
            and isset($_POST['id_sjizdi'])
        ){
            // provedu smazani uzivatele
            $ok = $this->db->deleteRiverReview(intval($_POST['id_sjizdi']));
            if($ok){
                $tplData['deleteRiverReview'] = "OK: Recenze byla smazána z databáze.";
            } else {
                $tplData['deleteRiverReview'] = "CHYBA: Recenzi se nepodařilo smazat z databáze (nejspíš je potřeba nejdříve smazat recenzi tábořiště).";
            }
        }

        if(isset($_POST['action']) and $_POST['action'] == "deleteCampReview"
            and isset($_POST['id_tabori'])
        ){
            // provedu smazani uzivatele
            $ok = $this->db->deleteCampReview(intval($_POST['id_tabori']));
            if($ok){
                $tplData['deleteCampReview'] = "OK: Recenze byla smazána z databáze.";
            } else {
                $tplData['deleteCampReview'] = "CHYBA: Recenzi se nepodařilo smazat z databáze (nejspíš je potřeba nejdříve smazat recenzi tábořiště).";
            }
        }

        $tplData['isUserLogged'] = $this->um->isUserLogged();
        $tplData['reviewedRivers'] = $this->db->getRiversReviewsByUser(MySessions::getSession("current_user_id"));
        $tplData['reviewedCamps'] = $this->db->getCampsReviewsByUser(MySessions::getSession("current_user_id"));

        //// vypsani prislusne sablony
        // zapnu output buffer pro odchyceni vypisu sablony
        ob_start();
        // pripojim sablonu, cimz ji i vykonam
        require(DIRECTORY_VIEWS ."/ReviewListTemplate.tpl.php");
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
}
<?php
// nactu rozhrani kontroleru
require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

class MakeReviewCampController implements IController
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
        $this->um = new UserModel();
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

        $tplData['isUserLogged'] = $this->um->isUserLogged();
        $tplData['allRivers'] = $this->db->getAllUserRivers(MySessions::getSession("current_user_id"));
        $tplData['allCamps'] = $this->db->getAllCamps();

        if(isset($_POST['action']) and $_POST['action'] == "addCampReview" and isset($_POST['river']) && isset($_POST['dateReview'])
            && isset($_POST['riverReview'])
            && $_POST['dateReview'] != "" && $_POST['riverReview'] != "" && $_POST['river'] > 0
        ){
            //die(print_r($_POST['dateReview']));
            $ok = $this->db->addCampReview(MySessions::getSession("current_user_id"),$_POST['dateReview'],$_POST['riverReview'],$_POST['river']);
            if($ok){
                $tplData['addCampReview'] = "OK: Recenze byla přidána do databáze.";
            } else {
                $tplData['addCampReview'] = "CHYBA: Recenzi se nepodařilo přidat do databáze.";
            }
        }

        //// vypsani prislusne sablony
        // zapnu output buffer pro odchyceni vypisu sablony
        ob_start();
        // pripojim sablonu, cimz ji i vykonam
        require(DIRECTORY_VIEWS ."/MakeReviewCampTemplate.tpl.php");
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
}
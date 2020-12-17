<?php
// nactu rozhrani kontroleru
require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

class MakeCampController implements IController
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
        $this->db= new DatabaseModel();
        $this->um= new UserModel();
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
        $tplData['allRivers'] = $this->db->getAllRivers();

        //NEFUNGUJE TO POD TIM

        if(isset($_POST['action']) and $_POST['action'] == "addCamp" and isset($_POST['camp']) && isset($_POST['capacity'])
            && isset($_POST['price']) && isset($_POST['river'])
            && $_POST['camp'] != "" && $_POST['capacity'] > 0 && $_POST['price'] > 0
        ) {

            if(isset($_POST['parking']))
            {
                $parking = "1";
            }else{
                $parking = "0"  ;
            }

            $ok = $this->db->addCamp($_POST['camp'], $_POST['capacity'], $_POST['price']
                ,$parking , $_POST['wc'], $_POST['showers'], $_POST['restaurant'], $_POST['river']);
            if ($ok) {
                $tplData['addCamp'] = "OK: Tábořiště bylo přidáno do databáze.";
            } else {
                $tplData['addCamp'] = "CHYBA: Tábořiště se nepodařilo přidat do databáze.";
            }
        }

            //// vypsani prislusne sablony
        // zapnu output buffer pro odchyceni vypisu sablony
        ob_start();
        // pripojim sablonu, cimz ji i vykonam
        require(DIRECTORY_VIEWS ."/MakeCampTemplate.tpl.php");
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
}
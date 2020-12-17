<?php
// nactu rozhrani kontroleru
require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

class MakeRiverController implements IController
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


        if(isset($_POST['action']) and $_POST['action'] == "addRiver" and isset($_POST['river']) && isset($_POST['distance'])
            && isset($_POST['weir'])
            && $_POST['river'] != "" && $_POST['distance'] > 0
        ){
            $ok = $this->db->addRiver($_POST['river'],$_POST['distance'],$_POST['weir']);
            if($ok){
                $tplData['addRiver'] = "OK: Řeka byla přidána do databáze.";
            } else {
                $tplData['addRiver'] = "CHYBA: Řeku se nepodařilo přidat do databáze.";
            }
        }

        //// vypsani prislusne sablony
        // zapnu output buffer pro odchyceni vypisu sablony
        ob_start();
        // pripojim sablonu, cimz ji i vykonam
        require(DIRECTORY_VIEWS ."/MakeRiverTemplate.tpl.php");
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
}
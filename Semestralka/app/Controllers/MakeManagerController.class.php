<?php
// nactu rozhrani kontroleru
require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

/**
 * Kontroller se stara o nastaveni spravce
 * @author Kment
 * Class MakeManagerController
 */
class MakeManagerController implements IController
{

    /** @var DatabaseModel $db  Sprava databaze. */
    private $um;

    /**
     * Inicializace pripojeni k databazi.
     */
    public function __construct() {
        // inicializace prace s DB
        //require_once (DIRECTORY_MODELS ."/DatabaseModel.class.php");
        require_once (DIRECTORY_MODELS ."/UserModel.class.php");
        require_once("MySessions.class.php");
        $this->um= new UserModel();
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

        $tplData['isUserLogged'] = $this->um->isUserLogged();

        $tplData['paddlers'] = $this->um->getAllPaddlers();

        if(isset($_POST['action']) and $_POST['action'] == "makeManager" and isset($_POST['paddlers']) && $_POST['paddlers'] > 0
        ){

            $ok = $this->um->appointManager($_POST['paddlers']);
            if($ok){
                $tplData['makeManager'] = "OK: Uživatel byl určen jako správce.";
            } else {
                $tplData['makeManager'] = "CHYBA: Uživatele se nepodařilo určit jako správce.";
            }
        }

        //// vypsani prislusne sablony
        // zapnu output buffer pro odchyceni vypisu sablony
        ob_start();
        // pripojim sablonu, cimz ji i vykonam
        require(DIRECTORY_VIEWS ."/MakeManagerTemplate.tpl.php");
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
}
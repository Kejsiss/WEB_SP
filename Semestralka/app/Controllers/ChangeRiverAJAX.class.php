<?php

class ChangeRiverAJAX
{

    /** @var DatabaseModel $db  Sprava databaze. */
    private $db;

    /**
     * Inicializace pripojeni k databazi.
     */
    public function __construct() {
        // inicializace prace s DB
        require_once ("../Models/DatabaseModel.class.php");
        $this->db = new DatabaseModel();

    }

    public function getSjizdi($river, $userId){

            $data = $this->db->getRiverDown($river, $userId);

        $final = "";
        foreach ($data as $d){
            $final .= "<option value='$d[id_SJIZDI]'>$d[datum_sjezdu]</option>";
        }

        return $final;
    }
}
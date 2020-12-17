<?php
///////////////////////////////////////////////////////////////////////////
/////////// Sablona pro zobrazeni stranky se spravou uzivatelu  ///////////
///////////////////////////////////////////////////////////////////////////

//// pozn.: sablona je samostatna a provadi primy vypis do vystupu:
// -> lze testovat bez zbytku aplikace.
// -> pri vyuziti Twigu se sablona obejde bez PHP.

//// vypis sablony
// urceni globalnich promennych, se kterymi sablona pracuje
global $tplData;



// pripojim objekt pro vypis hlavicky a paticky HTML
require(DIRECTORY_VIEWS ."/ZakladHTML.class.php");
$tplHeaders = new ZakladHTML();

?>
    <!-- ------------------------------------------------------------------------------------------------------- -->

    <!-- Vypis obsahu sablony -->
<?php

// hlavicka
$tplHeaders->getHTMLHeader($tplData['title']);

if($tplData['isUserLogged']){
    ?>
    <div class="container" id="inputTab text-center">
        <h4 class="text-center">Zde máš vypsané všechny své recenze!</h4><br>
        <h5>Recenze řek</h5><hr><br>
        <?php
            $rivers = "<div>";
            foreach($tplData['reviewedRivers'] as $r){
            $rivers .= "<h6>$r[nazev]</h6>"
                ."<p>Datum sjezdu: $r[datum_sjezdu]</p>"
                ."<div>Recenze: $r[recenze_reky]</div><br>";
            }

        $rivers .= "</div>";

            echo $rivers;
        ?>
        <h5>Recenze tábořišť</h5><hr><br>
        <?php
        $camps = "<div>";
        foreach($tplData['reviewedCamps'] as $c){
            $camps .= "<h6>$c[nazev]</h6>"
                ."<p>Datum utáboření: $c[datum_utaboreni]</p>"
                ."<div>Recenze: $c[recenze_taboriste]</div><br>";
        }

        $camps .= "</div>";

        echo $camps;
        ?>
    </div>
    <br>
    <?php
}else {
    ?>
    <h1 class="text-center">Tato sekce je pouze pro přihlášené uživatele</h1>
    <?php
}

// paticka
$tplHeaders->getHTMLFooter();

?>
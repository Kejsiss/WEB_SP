<?php
///////////////////////////////////////////////////////////////////////////
//////// Sablona pro zobrazeni stranky s uzivatelskymi recenzemi  /////////
///////////////////////////////////////////////////////////////////////////

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

// mam vypsat hlasku?
if(isset($tplData['deleteRiverReview'])){

    echo "<div class='alert alert-info'>$tplData[deleteRiverReview]</div>";
}
if(isset($tplData['deleteCampReview'])){
    echo "<div class='alert alert-info'>$tplData[deleteCampReview]</div>";
}

if($tplData['isUserLogged']){
    //SEKCE PRO PRIHLASENE UZIVATELE
    ?>
    <div class="container" id="inputTab text-center">
        <h4 class="text-center">Zde máš vypsané všechny recenze vybraného uživatele!</h4><br>
        <h5>Recenze řek</h5><hr><br>
        <?php
        $rivers = "<div>";
        foreach($tplData['reviewedRivers'] as $r){
            $rivers .= "<h6>$r[nazev]</h6>"
                ."<p>Datum sjezdu: $r[datum_sjezdu]</p>"
                ."<div>Recenze: $r[recenze_reky]</div><br><form method='post'>"
                ."<input type='hidden' name='id_sjizdi' value='$r[id_SJIZDI]'>"
                ."<button type='submit' name='action' value='deleteRiverReview' style='background-color: #236AB9; color: #D4E4F7'>Smazat</button></form><br>";
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
                ."<div>Recenze: $c[recenze_taboriste]</div><br><form method='post'>"
                ."<input type='hidden' name='id_tabori' value='$c[id_TABORI]'>"
                ."<button type='submit' name='action' value='deleteCampReview' style='background-color: #236AB9; color: #D4E4F7'>Smazat</button></form><br>";
        }

        $camps .= "</div>";

        echo $camps;
        ?>
    </div>
    <br>
    </div>
<?php
}else {
    //SEKCE PRO NEPRIHLASENE UZIVATELE
    ?>
    <h1 class="text-center">Tato sekce je pouze pro přihlášené uživatele</h1>
    <?php
}

// paticka
$tplHeaders->getHTMLFooter()

?>
<?php
///////////////////////////////////////////////////////////////////////////
/////////// Sablona pro zobrazeni stranky s vytvarenim kempu  /////////////
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

if(isset($tplData['addCamp'])){
    echo "<div class='alert alert-info'>$tplData[addCamp]</div>";
}

if($tplData['isUserLogged']){
    //SEKCE PRO PRIHLASENE UZIVATELE
    ?>
    <div class="container" id="inputTab text-center">
        <h4 class="text-center">Zde můžeš přidat tábořiště do databáze!</h4><br>
        <form method="POST" action="" class="form-inline justify-content-center" role="form">
            <div>
                <div class="form-group">
                    <label for="camp">Název kempu:&nbsp</label>
                    <input type="text" class="form-control col-sm-12" id="camp" name="camp">
                </div><br>
                <div class="form-group">
                    <label for="capacity">Kapacita:&nbsp</label>
                    <input type="number" class="form-control col-sm-12" id="capacity" name="capacity">
                </div><br>
                <div class="form-group">
                    <label for="pricePerNight">Cena za noc:&nbsp</label>
                    <input type="number" class="form-control col-sm-12" id="pricePerNight" name="price">
                </div><br>
                <div class="form-group">
                    <label for="parking" class="col-sm-6">Parkoviště:&nbsp</label>
                    <input type="checkbox" class="form-control col-sm-1" id="parking" name="parking">
                </div><br>
                <div class="form-group">
                    <label for="WC" class="col-sm-6">WC:&nbsp</label>
                    <input type="checkbox" class="form-control col-sm-1" id="WC" name="wc">
                </div><br>
                <div class="form-group">
                    <label for="showers" class="col-sm-6">Sprchy:&nbsp</label>
                    <input type="checkbox" class="form-control col-sm-1" id="showers" name="showers">
                </div><br>
                <div class="form-group">
                    <label for="restaurant" class="col-sm-6">Restaurace:&nbsp</label>
                    <input type="checkbox" class="form-control col-sm-1" id="restaurant" name="restaurant">
                </div><br>
                <div class="form-group">
                    <label for="reka" class="col-sm-6">Řeka:&nbsp</label>
                    <select name="river" id="reka">
                        <?php
                        foreach($tplData['allRivers'] as $r){
                            echo "<option value='$r[id_REKA]'>$r[nazev]</option>";
                        }
                        ?>
                    </select>
                </div><br>
                <div style="text-align:center;">
                    <button type='submit' name='action' value='addCamp' class="btn" style="background-color: #236AB9; color: #D4E4F7">Přidat tábořiště</button>
                </div>
            </div>
        </form>
    </div>
    <br>
    <?php
}else {
    //SEKCE PRO NEPRIHLASENE UZIVATELE
    ?>
    <h1 class="text-center">Tato sekce je pouze pro přihlášené uživatele</h1>
    <?php
}

// paticka
$tplHeaders->getHTMLFooter();

?>
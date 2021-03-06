<?php
///////////////////////////////////////////////////////////////////////////
//////// Sablona pro zobrazeni stranky s vytvarenim recenze reky  /////////
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

if(isset($tplData['addRiverReview'])){
    echo "<div class='alert alert-info'>$tplData[addRiverReview]</div>";
}

if($tplData['isUserLogged']){
    //SEKCE PRO PRIHLASENE UZIVATELE
    ?>
    <div class="container" id="inputTab text-center">
        <h4 class="text-center">Zde můžeš napsat recenzi řece!</h4><br>
        <form method="POST" action="" class="form-inline justify-content-center" role="form">
            <div>
                <div class="form-group">
                    <label for="role" class="col-sm-6">Řeka:&nbsp</label>
                    <select name="river" id="reka">
                        <?php
                        foreach($tplData['allRivers'] as $r){
                            echo "<option value='$r[id_REKA]'>$r[nazev]</option>";
                        }
                        ?>
                    </select>
                </div><br>
                <div class="form-group">
                    <label for="date" class="col-sm-6">Datum sjezdu:&nbsp</label>
                    <input type="date" class="form-control col-sm-6" id="date" name="dateReview">
                </div><br>
                <div class="form-group">
                    <label for="review">Recenze:&nbsp</label>
                    <textarea type="text-area" class="form-control col-sm-12" id="review" rows="5" name="riverReview"></textarea>
                </div><br>
                <div style="text-align:center;">
                    <button type='submit' name='action' value='addRiverReview' class="btn" style="background-color: #236AB9; color: #D4E4F7">Přidat recenzi</button>
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
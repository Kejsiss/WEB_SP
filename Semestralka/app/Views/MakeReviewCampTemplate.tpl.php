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

if(isset($tplData['addCampReview'])){
    echo "<div class='alert alert-info'>$tplData[addRiverReview]</div>";
}

if($tplData['isUserLogged']){
    ?>
    <div class="container" id="inputTab text-center">
        <h4 class="text-center">Zde můžeš napsat recenzi řece!</h4><br>
        <form method="POST" action="" class="form-inline justify-content-center" role="form">
            <div>
                <div class="form-group">
                    <label for="role" class="col-sm-6">Tábořiště:&nbsp</label>
                    <select name="camp" id="kemp">
                        <?php
                        // ziskam vsechna prava
                        // projdu je a vypisu
                        foreach($tplData['allCamps'] as $c){
                            echo "<option value='$c[id_TABORISTE]'>$c[nazev]</option>";
                        }
                        ?>
                    </select>
                </div><br>
                <div class="form-group">
                    <label for="role" class="col-sm-6">Řeka:&nbsp</label>
                    <select name="river" id="reka">
                        <?php
                        // ziskam vsechna prava
                        // projdu je a vypisu
                        foreach($tplData['allRivers'] as $r){
                            echo "<option value='$r[id_REKA]'>$r[nazev]</option>";
                        }
                        ?>
                    </select>
                </div><br>
                <div class="form-group">
                    <label for="date" class="col-sm-6">Datum utáboření:&nbsp</label>
                    <input type="date" class="form-control col-sm-6" id="date" name="dateCamp">
                </div><br>
                <div class="form-group">
                    <label for="review">Recenze:&nbsp</label>
                    <textarea type="text-area" class="form-control col-sm-12" id="review" rows="5" name="campReview"></textarea>
                </div><br>
                <div style="text-align:center;">
                    <button type='submit' name='action' value='addCampReview' class="btn" style="background-color: #236AB9; color: #D4E4F7">Přidat recenzi</button>
                </div>
            </div>
        </form>
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
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
    echo "<div class='alert alert-info'>$tplData[addCampReview]</div>";
}

if($tplData['isUserLogged']){
    ?>
    <div class="container" id="inputTab text-center">
        <h4 class="text-center">Pro napsání recenze tábořiště musíš mít nejdřív napsanou recenzi pro danou řeku!</h4><br>
        <form method="POST" action="" class="form-inline justify-content-center" role="form">
            <div>
                <div class="form-group">
                    <label for="role" class="col-sm-3">Tábořiště:&nbsp</label>
                    <select name="camp" id="kemp">
                        <?php
                        // ziskam vsechna prava
                        // projdu je a vypisu
                        foreach($tplData['allCamps'] as $c){

                            $id = $c['id_TABORISTE'].",".$c['id_reka'].",".$tplData['user'];
                            $tplData['id'] = $c['id_TABORISTE'];
                            echo "<option value='$id'>$c[nazev]</option>";
                        }
                        ?>
                    </select>
                </div><br>
                <div class="form-group">
                    <label for="role" class="col-sm-3">Sjezdy:&nbsp</label>
                    <select name="river" id="data">
                    </select>
                </div><br>
                <div class="form-group">
                    <label for="date" class="col-sm-4">Datum utáboření:&nbsp</label>
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

    <script>
        $(document).ready(function(){
            $("#kemp").on("change",function(){
                changeRiver();
            });
        });

        function changeRiver(){

            var kemp = $("#kemp").val();
            var data = kemp.split(',');
            var id = data[0];
            var river = data[1];
            var user = data[2];

            $.get({
                type: "POST",
                url: "/dashboard\\phpZkouska\\WEB_SP\\Semestralka\\app\\Controllers\\zkouska.php",
                cache:false,
                data: {id : id, reka : river, uzivatel : user},
                success: function(response){
                    $("#data").empty().append(response);
                },
                error: function(){
                    alert("Nastala chyba!");
                }
            });
        }

    </script>
    <?php
}else {
    ?>
    <h1 class="text-center">Tato sekce je pouze pro přihlášené uživatele</h1>
    <?php
}

// paticka
$tplHeaders->getHTMLFooter();

?>
<?php
//////////////////////////////////////////////////////////////
////////////// HTML Zaklad vsech stranek webu ////////////////
//////////////////////////////////////////////////////////////
require_once("MySessions.class.php");
/**
 * Trida pro vypis hlavicky a paticky HTML stranky.
 */
class ZakladHTML {

    /**
     *  Vytvoreni hlavicky stranky.
     *  @param string $title Nazev stranky.
     */
    public function getHTMLHeader(string $pageTitle){
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title><?= $pageTitle ?></title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
            <script src='https://kit.fontawesome.com/a076d05399.js'></script>
            <script
                    src="https://code.jquery.com/jquery-3.4.1.min.js"
                    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
                    crossorigin="anonymous"></script>
            <style>
                body{
                    background-color: #D4E4F7;
                }
                header{
                    background-color: #236AB9;
                    margin-bottom:0;
                }
                nav{
                    background-color: #341C09;
                    margin-bottom: 2%;

                }
                footer{
                    background-color: #341C09;
                    margin-bottom: 0;
                    padding-bottom: 0;

                    position:relative;
                    bottom:0;
                    width:100%;
                    margin-top: 100%;
                }
                h1{
                    color: #341C09;
                    font-weight: bold;
                }
                h5{
                    color: #FC7307;
                    font-weight: bold;
                }
                a{
                    color:  #FC7307;
                    font-size: 20px;
                }
                a:hover{
                    color:#236AB9;
                }
                i{
                    color: #236AB9;
                    font-size: 20px;
                    padding: 5px;
                }
                .navbar-toggler{
                    background-color:#FC7307;
                }
                li{
                    padding: 15px;
                }
                .center {
                    margin-left: auto;
                    margin-right: auto;
                }
                /* Extra small devices (phones, 600px and down) */
                /*@media only screen and (min-width: 600px) {
                    footer{
                        background-color: #341C09;
                        margin-bottom: 0;
                        padding-bottom: 0;
                        margin-top: 100%;
                        position: absolute;
                        bottom: 0;
                        width: 100%;
                    }
                }*/
            </style>

        </head>
        <body>
        <header class="jumbotron text-center" style="background-color:#236AB9; margin-bottom:0" >
            <h1 class="display-2">Portál recenzí řek a jejich tábořišť</h1>
            <h2 style="color:#341C09;">Zde nalezneš recenze tábořišť a řek, které máš v plánu sjet!</h2>
        </header>
        <nav class="navbar navbar-expand-sm navbar-inverse">
            <div class="container">
                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon">
                    <i class="fas fa-bars" style="color:#D4E4F7; font-size:28px;"></i>
                </span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <?php
                        // vypis menu
                        foreach(WEB_PAGES as $key => $pInfo){
                            if($key == 'reky'){
                                echo "<li class='nav-item'><i class='fas fa-water'></i><a href='index.php?page=$key'>$pInfo[title]</a></li>";
                            }
                            elseif($key == 'taboriste'){
                                echo "<li class='nav-item'><i class='fas fa-campground'></i><a href='index.php?page=$key'>$pInfo[title]</a></li>";
                            }
                            elseif ($key == 'domov'){
                                echo "<li class='nav-item'><i class='fas fa-home'></i><a href='index.php?page=$key'>$pInfo[title]</a></li>";
                            }
                        }
                        ?>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <?php
                        // vypis menu
                        foreach(WEB_PAGES as $key => $pInfo){
                            if($key == 'login'){
                                if(MySessions::sessionExists("current_user_id")) {
                                    echo "<li class='nav-item dropdown'><a class='nav-link nav-link dropdown-toggle' href='#' id='navbardrop' data-toggle='dropdown'>
                                            <i class='fas fa-edit'></i>Správa</a>
                                                <div class='dropdown-menu'>
                                                    <a class='dropdown-item' href='index.php?page=recenzeList'>Seznam recenzí</a>
                                                    <a class='dropdown-item' href='index.php?page=vytvoritRecenziReky'>Vytvořit recenzi řeky</a>
                                                    <a class='dropdown-item' href='index.php?page=vytvoritRecenziKempu'>Vytvořit recenzi kempu</a>";
                                                    if(MySessions::getSession("user_right") <= 2) {
                                                        echo "<a class='dropdown-item' href='index.php?page=vytvoritReku'>Přidat řeku</a>
                                                              <a class='dropdown-item' href='index.php?page=vytvoritKemp'>Přidat kemp</a>
                                                              <a class='dropdown-item' href='index.php?page=spravaRecenzi'>Správá uživatelských recenzí</a>";
                                                        if(MySessions::getSession("user_right") == 1) {
                                                            echo "<a class='dropdown-item' href='index.php?page=urcitSpravce'>Přidat správce</a>";
                                                            echo "<a class='dropdown-item' href='index.php?page=spravaUzivatelu'>Správa uživatelů</a>";
                                                        }
                                                    }
                                               "</div>
                                            </li>";

                                    echo "<li class='nav-item'><i class='fas fa-user-circle'></i><a href='index.php?page=$key'>Odhlásit</a></li>";
                                }
                                else {
                                    echo "<li class='nav-item'><i class='fas fa-user-circle'></i><a href='index.php?page=$key'>Přihlásit</a></li>";

                                }
                           }
                            elseif($key == 'register' && !(MySessions::sessionExists("current_user_id"))){
                                echo "<li class='nav-item'><i class='fas fa-user'></i><a href='index.php?page=$key'>$pInfo[title]</a></li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <?php
    }

    /**
     *  Vytvoreni paticky.
     */
    public function getHTMLFooter(){
        ?>
        <footer class="py-1 mt-1 text-center font-weight-bold relative-bottom">
            <h5 style="color: #FC7307; padding-top: 1%; padding-bottom: 1%">&copy;Tomáš Kment 2020</h5>
        </footer>
    </body>

    <!-- ------------- JavaScripty ------------- -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    </html>
        <?php
    }

}
?>

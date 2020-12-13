<?php
//////////////////////////////////////////////////////////////
////////////// HTML Zaklad vsech stranek webu ////////////////
//////////////////////////////////////////////////////////////

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
                    margin-top: 100%;
                }
                h1{
                    color: #341C09;
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
                }
                .navbar-toggler{
                    background-color:#FC7307;
                }
                button {
                    background: none!important;
                    border: none;
                    padding: 0!important;
                    /*optional*/
                    font-family: arial, sans-serif;
                    /*input has OS specific font-family*/
                    color: #069;
                    text-decoration: underline;
                    cursor: crosshair;
                }
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
                        <li class="nav-item"><a class="nav-link" href="index.html"><i class='fas fa-home'></i>  Domů</a></li>
                        <li class="nav-item"><a class="nav-link" href="camps.html"><i class='fas fa-campground'></i>    Tabořiště</a></li>
                        <li class="nav-item"><a class="nav-link" href="camps.html"><i class='fas fa-water'></i>    Řeky</a></li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="../index.php?page=login"><i class='fas fa-user-circle'></i>    Přihlášení</a></li>
                        <li class="nav-item"><a class="nav-link" href="../index.php?page=registrace"><i class='fas fa-user'></i>    Zaregistrovat</a></li>

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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    </html>
        <?php
    }

}
?>

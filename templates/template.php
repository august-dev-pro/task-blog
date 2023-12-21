<link rel="stylesheet" href="../../css/home.scss">
<link rel="stylesheet" href="../../css/template.scss">
<link rel="stylesheet" href="../../css/nav-bar.scss">
<?php
$isLoged = (isset($_SESSION["user"]) and ($_SESSION["user"]["role"] == "user"
    or ($_SESSION["user"]["role"] == "admin" or $_SESSION["user"]["role"] == "super_admin")))  ?? null;

$dashbordPermit = (isset($_SESSION["user"]) and ($_SESSION["user"]["role"] == "admin" or $_SESSION["user"]["role"] == "super_admin"))  ?? null;
?>
<header class="header_section">
    <div class="containe">
        <div class="header_section_content">
            <!--bar bibliotech-->
            <div class="nav-bars">
                <span></span>
                <span></span>
                <span id="tree_bar"></span>
            </div>



            <!--nav bar blog-->
            <nav class="nav_bar">

                <button class="nav_bar_link">
                    <a href="/register">s'inscrire</a>
                </button>

                <button class="nav_bar_link">
                    <a href="/">Home</a>
                </button>


                <?php if ($isLoged) {  ?>
                    <button class="nav_bar_link">
                        <a href="/logout">Logout</a>
                    </button>
                <?php } else {  ?>
                    <button class="nav_bar_link">
                        <a href="/login">Login</a>
                    </button>
                <?php } ?>

                <?php if ($dashbordPermit) {  ?>
                    <button class="nav_bar_link">
                        <a href="/administration">Dashbord</a>
                    </button>
                <?php } ?>
            </nav>
        </div>
    </div>
</header>


<?php
echo $content;
?>

<section class="footer_section">
    <div class="containe">
        <div class="footer_content">FOOTER</div>
    </div>
</section>
<script src="../js/sliderjs.js"></script>
<script src="../js/main.js"></script>

<?php
	session_start();
	if(!isset($_SESSION['USERNAME'])){
		header("location:login.php");
	}

?>
    <!DOCTYPE html>
    <html lang="en" style="padding-right: 0px;">

    <head>
        <title>Equipment</title>
        <link rel="stylesheet" href="css/materialize.min.css">
        <link rel="stylesheet" href="css/style.css">

        <script>
            var userId = <?php echo $_SESSION['USER_ID']; ?>;
        </script>

    </head>

    <body>
        <!-- This is the page header -->
        <header>

            <nav class="top-nav" id="pageheader">
                <div class="container">
                    <div class="nav-wrapper">
                        <a class="page-title">Ashesi Engineering Inventory</a>
                    </div>
                </div>
            </nav>

            <ul id="mainnav" class="side-nav fixed " style="width: 240px;">
                <li id="logo">
                    <img class="responsive-img circle center" src="images/logo.png">
                </li>
                <li>
                    <a href="#">
                        <?php echo $_SESSION['USERNAME']?>
                            logged in</a>
                </li>
                <li>
                    <a href="index.php">
                        <div>Home</div>
                    </a>
                </li>
                <li>
                    <a href="equipment_page.php">
                        <div>Equipment</div>
                    </a>
                </li>
                <li>
                    <a href="labpage.php">
                        <div>Labs</div>
                    </a>
                </li>
                <li>
                    <a href="suppliers_page.php">
                        <div>Supplier</div>
                    </a>
                </li>
                <li>
                    <a href="history.php">
                        <div><b>History</b></div>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <div>Logout</div>
                    </a>
                </li>
            </ul>

        </header>

        <!-- This is the main section of the page -->
        <main>
            <!--            <div class="container">-->
            <div class="row">
                <div class="col s12 m9 l12">


                    <div id="content" class="card-panel grey lighten-2">
                        <div id="divPageMenu">
<!--
                            <div align="right">
                                <input type="text" placeholder="Search" id="txtSearch" />
                                <span id="search" class="menuitem" onclick="search()">search</span>
                            </div>
-->
                        </div>
                        <div id="divStatus" class="status">
                            status message
                        </div>
                        <div id="divContent">
                            <div id="contentSpace"></div>
                            <table id="table" class="reportTable bordered" width="100%">

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </main>
        <footer></footer>

        <script src="jquery-2.1.3.js"></script>
        <script src="js/materialize.min.js"></script>
        <script src="js/history_page.js"></script>
    </body>

    </html>

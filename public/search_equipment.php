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
                        <div >Home</div>
                    </a>
                </li>
                <li>
                    <a href="equipment_page.php">
                        <div><b>Equipment</b></div>
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
                        <div>History</div>
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
                                <div style="float:left">
                                    <span id="change" class="menuitem" onclick="loadAddEquipmentForm()">Add Equipment</span>
                                    <span class="menuitem" id="edit" onclick="loadEditEquipmentForm()" hidden="true">Edit</span>
                                    <span class="menuitem" onclick="deleteEquip()" id="deleteE" hidden="true">Delete</span>
                                    <span class="menuitem" id="exit" onclick="exitView()" hidden="true">Exit</span>
                                </div>
                                <div align="right">
                                    <input type="text" placeholder="Search" id="txtSearch" />
                                    <span id="search" class="menuitem" onclick="search()">search</span>
                                </div>
                            </div>
                            <div id="divStatus" class="status">
                                status message
                            </div>
                            <div id="divContent">
                                <div id="contentSpace"></div>
                                <table id="tableExample" class="reportTable bordered" width="100%">
                                    <?php

include_once("../application/models/equipment.php");
$searchText = "";
		if (isset($_REQUEST['st'])) {
			$searchText = $_REQUEST['st'];
		}
    //form for user input
		echo "<form action='search_equipment.php' method='GET'>"
			."<input type='text' name='st' value='$searchText'>"
			."<input type='submit' value='search'>"
			. "</form>";

$obj= new equipment();
$obj->search_equipment($searchText);
//$lab= new equipment();
	echo"<tr class='header'>
		<td data-field='serial_number'>Serial Number</td>
		<td data-field='name'>Equipment Name</td>
		<td data-field='name'>Lab</td>
		<td data-field='date'>Date Purchased</td>
	    </tr>";

    $count=0;
	while ($row=$obj->fetch()) {
        if ($count==0) {
            $color = 'row1';
            $count=1;
        }
        else {
            $color = 'row2';
            $count=0;
        }
		echo "<tr onclick='loadViewEquip($row[equipment_id])' class=$color style='cursor:pointer'><td>$row[serial_number]</td>";
		echo "<td>$row[equipment_name]</td>";
		echo "<td>$row[lab_id]</td>";
		echo "<td>$row[date_purchased]</td></tr>";
	}

?>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

        </main>
        <footer></footer>

        <script src="jquery-2.1.3.js"></script>
        <script src="js/equipment_page.js"></script>
        <script src="js/materialize.min.js"></script>
    </body>

    </html>

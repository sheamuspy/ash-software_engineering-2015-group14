<?php
/**
 * author: Rahila Sule
 * description: A php file that contains html for the equipment tab landing page. It displays a list of equipment
 */
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/equipment_page.js"> </script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

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
                <a href="#"> Welcome, 
                    <?php echo $_SESSION['USERNAME']?>
                 </a>
            </li>

             <li>
                <a href="index.php">
                    <div>Home</div>
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
   <!--  <div class="container">-->
                <div class="row">
                    <div class="col s12 m9 l12">


                        <div id="content" class="card-panel grey lighten-2">
                            <div id="divPageMenu">
                                <div style="float:left">
                                   <!-- <span id="change" class="menuitem" onclick="loadAddEquipmentForm()">Add Equipment</span> -->
                                    <span class="menuitem modal-trigger" href="#editmodal" id="edit" hidden="true">Edit</span>
                                    <span class="menuitem modal-trigger" href="#checkoutmodal" id="checkout" hidden="true">Checkout</span>
                                    <span class="menuitem" onclick="deleteEquip()" id="deleteE" hidden="true">Delete</span>
                                    <span class="menuitem" id="exit" onclick="exitView()" hidden="true">Exit</span>                               
                                </div>
                                
                                <div align="right">
                                     <!-- Modal Trigger -->
                                    <button class="modal-trigger waves-effect waves-light btn " href="#addmodal" aligh="right">Add Equipment</button>
                                    <input type="text" placeholder="Search" id="txtSearch">
                                    <span id="search" class="menuitem" onclick="search()">search</span>
                                </div>
                                
                            </div>

      <!-- Modal Structure -->
      <div id="addmodal" class="modal modal-fixed-footer">
            <!-- Modal content -->
                <div class="modal-content">
        
          <h4>Add Equipment</h4>

          <table>
            <tr>
                <td>Equipment Name: </td><td><input type="text" id="en" required></td>
            </tr>
            <tr>
                <td>Serial Number: </td><td><input type="text" id="sn" required></td>
            </tr>
            <tr>
                <td>Inventory Number: </td><td><input type="text" id="inv" size="30" required></td>
            </tr>
                <td>Lab ID:</td>
                <td><select class="browser-default" id="lid">
                            <option value="0">--Select Lab--</option>
                            <?php
                            include_once("../application/models/labs.php");
                            $sup=new labs();
                            
                            $sup->get_all_labs();
                            while($sup_row=$sup->fetch()){
                                
                                // if($sup_row['lab_id']==$row['lab_id']){
                                    // echo "<option value='{$sup_row['lab_id']}' selected>{$sup_row['lab_name']}</option>";
                                // }else{
                                    echo "<option value='{$sup_row['lab_id']}'>{$sup_row['lab_name']}</option>";
                                // }
                                
                            }
                        ?>
                    </select>
                </td>
            <tr>
                <td>Date Purchased:</td><td> <input type="date" class="datepicker" id="dp" size="30" required></td>
            </tr>
            <tr>
                <td>Supplier ID:</td><td> <select class="browser-default" id="sid">
                                <option value="0">--Select Supplier--</option>
                                <?php
                            include_once("../application/models/suppliers.php");
                            $sup=new suppliers();
                            
                            $sup->get_suppliers();
                            while($sup_row=$sup->fetch()){
                                
                                // if($sup_row['supplier_id']==$row['supplier_id']){
                                //     echo "<option value='{$sup_row['supplier_id']}' selected>{$sup_row['supplier_name']}</option>";
                                // }else{
                                    echo "<option value='{$sup_row['supplier_id']}'>{$sup_row['supplier_name']}</option>";
                                // }
                                
                            }
                        ?>
                </td>
            </tr>
            <tr>
                <td>Description:</td> <td><textarea id="ed" cols="30" rows="5"required></textarea></td>
</tr>
        </table>
        </div>
        <div class="modal-footer">
            <a href="#!" onclick="addEquipment()" class="modal-action modal-close waves-effect waves-green btn-flat ">ADD</a>
        </div>
      
      </div>
      </div>

      <!-- Modal Structure -->
      <div id="editmodal" class="modal modal-fixed-footer">
            <!-- Modal content -->
                <div class="modal-content">
        
          <h4>Edit Equipment</h4>


          <table>
    <tr>
    <td>Equipment Name:</td><td> <input type="text" value="<?php echo $row['equipment_name']?>" id="en" required></td>
    </tr>
    <tr>
    <td>Serial Number: </td><td><input type="text" value="<?php echo $row['serial_number']?>" id="sn" required></td>
    </tr>
    
    <tr>
    <td>Inventory Number:</td><td> <input type="text" value="<?php echo $row['inventory_number']?>" id="inv" required></td>
    </tr>
    <tr>
    <td>Lab:</td><td><select id="lid" required>
                <option value="0">--Select Lab--</option>
                <?php
                    include_once("../application/models/labs.php");
                    $sup=new labs();
                    $sup->get_all_labs();
                    while($sup_row=$sup->fetch()){
                        
                        if($sup_row['lab_id']==$row['lab_id']){
                            echo "<option value='{$sup_row['lab_id']}' selected>{$sup_row['lab_name']}</option>";
                        }else{
                            echo "<option value='{$sup_row['lab_id']}'>{$sup_row['lab_name']}</option>";
                        }
                        
                    }
                ?>
                </td>
    </tr>
    <tr>
    <td>Date Purchased:</td><td> <input type="date" value="<?php echo $row['date_purchased']?>" id="dp" required></td>
    </tr>
    <tr>
    <td>Supplier:</td><td> <select id="sid" required>
                    <?php
                    include_once("../application/models/suppliers.php");
                    $sup=new suppliers();
                    $sup->get_suppliers();
                    while($sup_row=$sup->fetch()){
                        
                        if($sup_row['supplier_id']==$row['supplier_id']){
                            echo "<option value='{$sup_row['supplier_id']}' selected>{$sup_row['supplier_name']}</option>";
                        }else{
                            echo "<option value='{$sup_row['supplier_id']}'>{$sup_row['supplier_name']}</option>";
                        }
                        
                    }
                ?>
    </td>
    </tr>
    <tr>
    <td>Description: </td><td><textarea id="ed" cols="30" rows="5" required><?php echo $row['description']?></textarea></td>
    </tr>
</table>
        </div>
        <div class="modal-footer">
            <a href="#!" onclick="editEquipment()" class="modal-action modal-close waves-effect waves-green btn-flat ">UPDATE</a>
        </div>
      
      </div>
      </div>

      <!-- Modal Structure -->
      <div id="checkoutmodal" class="modal modal-fixed-footer">
        <!-- Modal content -->
        <div class="modal-content">
        
        <h4>Checkout Equipment</h4>
         <tr>
            <td>User ID:</td><td> <input type="text" id="uid" required></td>
        </tr>
        <tr>
            <td>Equipment ID: </td><td><input type="text"  id="eid" required></td>
        </tr>
        <tr>
            <td>Checkout date: </td><td><input type="date"  id="ed" required></td>
        </tr>

        <table>
        </table>

        </div>
        <div class="modal-footer">
            <a href="#!" onclick="checkoutEquipment()" class="modal-action modal-close waves-effect waves-green btn-flat ">CHECKOUT</a>
        </div>
      
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
$obj= new equipment();
$obj->display_equipment();
//$lab= new equipment();
	echo"<tr class='header'>
		<td data-field='serial_number'>Serial Number</td>
		<td data-field='name'>Equipment Name</td>
		<td data-field='name'>Lab</td>
		<td data-field='date'>Date Purchased</td>
        <td data-field='available'>Available</td>
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
		echo "<td>$row[date_purchased]</td>";
        echo "<td>$row[available]</td></tr>";
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

        <script src="js/materialize.min.js"></script>
        <script src="js/equipment_page.js"></script>
    </body>

    </html>

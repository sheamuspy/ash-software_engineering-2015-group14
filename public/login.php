<?php
if (isset($_REQUEST['loginUsername'])) {
    session_start();
    include_once("../application/models/users.php");
    $u_name = $_REQUEST['loginUsername'];
	$p_word = $_REQUEST['loginPassword'];
	$obj = new users();
	$row = $obj->user_password_validation($u_name,$p_word);
	if (!$row) {
		echo "<div class='center'>wrong credentials</div>";
	} else {
		$_SESSION['USER_ID'] = $row['user_id'];
		$_SESSION['USERNAME'] = $row['user_name'];
		$_SESSION['PASSWORD'] = $_REQUEST['password'];
		header("location:index.php");
	}
}
?>
<!DOCTYPE html>
<html>

<head>
    <script src="jquery-2.1.3.js"></script>
    <script src="js/login.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/materialize.min.css" />
</head>

<body>
    <div class="row">
        <div class="col s4 offset-s4">
            <form method="POST" action="login.php" class="card-panel">
                <div class="row center">
                    <div class="col s4 offset-s1 valign-wrapper">
                        <h5 class="valign right-align">Username</h5>
                    </div>
                    <div class="col s6">
                        <input type="text" placeholder="Username" name="loginUsername" required>
                    </div>
                </div>
                <div class="row center">
                    <div class="col s4 offset-s1 valign-wrapper">
                        <h5 class="valign right-align">Password</h5>
                    </div>
                    <div class="col s6">
                        <input type="password" placeholder="Password" name="loginPassword" required>
                    </div>
                </div>
                <div class="row center">
                    <button class="btn waves-effect waves-light" type="submit">Login</button>
                </div>



            </form>
        </div>
    </div>

</body>

</html>

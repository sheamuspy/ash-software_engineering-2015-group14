<?php
if (isset($_REQUEST['loginUsername'])) {
    session_start();
    include_once("../application/models/users.php");
    $u_name = $_REQUEST['loginUsername'];
	$p_word = $_REQUEST['loginPassword'];
	$obj = new users();
	$row = $obj->user_password_validation($u_name,$p_word);
	if (!$row) {
		echo "wrong credentials";
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
</head>

<body>
    <form method="POST" action="login.php">
        <table align="center">
            <tr>
                <td>Username</td>
                <td>
                    <input type="text" placeholder="Username" name="loginUsername" required>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type="password" placeholder="Password" name="loginPassword" required>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit">Login</button>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>

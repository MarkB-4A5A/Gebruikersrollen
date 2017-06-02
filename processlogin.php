<?php
    session_start();
    if(isset($_SESSION["logged_in"])) {
        header("Location: index.php");
    }

    require("classes/Database.class.php");

    $admin_name = $_POST["admin_name"];
    $admin_password = $_POST["admin_password"];

    $db = new Database("localhost","gebruikersrollen","root","");
    $sql = "SELECT * FROM admins WHERE admin_name=? LIMIT 1";
    $result = $db->ReadDataSecure($sql,":admin_name",$admin_name);

    if(password_verify($admin_password, $result["admin_password"])){
        echo "You are now logged in";
        $_SESSION["logged_in"] = true;
        $_SESSION["admin_name"] = $result["admin_name"];
        $_SESSION["role_id"] = $result["role_id"];
    } else {
        echo "Credentials do not match, you will be redirected to the home page";
    }


?>

<script>

    setTimeout(function(){ window.location.href = "index.php"; }, 3000);

</script>

<?php
if(isset($_REQUEST['city'])){
    $_SESSION['SCty'] = $_REQUEST['city'];
}

header("Location: ../views/main.php");
?>
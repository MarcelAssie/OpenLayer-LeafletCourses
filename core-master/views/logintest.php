<?php
// Test si l'utilisateur est connecté
$loginTest = null;
if(isset($_SESSION["user"])) {
    $loginTest = true;
}else {
    $loginTest = false;
}
?>
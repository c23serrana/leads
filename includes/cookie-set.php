<?php

if(!isset($_COOKIE["Session"])  or $_COOKIE["Session"]=="false"){

$cookie_name = "Session";
$cookie_value = $login_success;
setcookie($cookie_name, $cookie_value, time() + (1200), "/leads");
}

?>
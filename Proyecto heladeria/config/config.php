<?php

define("CLIENT_ID", "AanSINWZhV2c1Ww6rvY7GhQUz-QM5MalKNoN6nkdk938UPdwjPUmunqIPBg48YNIxxnWjF-mgDApdxi5");
define("CURRENCY", "COP");
define("KEY_TOKEN", "APR.wqc-354");
define("MONEDA", "$");

session_start();

$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}

?>
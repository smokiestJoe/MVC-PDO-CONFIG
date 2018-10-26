<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 25/05/2018
 * Time: 18:49
 */

session_start();

$_SESSION['set_config'] = false;

include_once __DIR__ . "/../headers/systemHeader.php";

error_reporting(E_ALL); ini_set('display_errors', '1');

if(isset($_POST['load_jquery'])) {

    $loadJquery = "LOAD_JQUERY:TRUE";

} else {

    $loadJquery = "LOAD_JQUERY:FALSE";
}

if(isset($_POST['load_bootstrap'])) {

    $loadBootstrap = "LOAD_BOOTSTRAP:TRUE";

} else {

    $loadBootstrap = "LOAD_BOOTSTRAP:FALSE";
}

new PluginWriter($loadBootstrap, $loadJquery);

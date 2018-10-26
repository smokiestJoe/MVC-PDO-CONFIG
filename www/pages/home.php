<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 22/04/2018
 * Time: 15:26
 */

session_start();

require_once __DIR__ . "/../../src/headers/systemHeader.php";

error_reporting(E_ALL); ini_set('display_errors', '1');

$htmlPage = new HtmlPageRenderer();

$htmlPage->render('home');

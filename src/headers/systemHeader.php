<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 23/04/2018
 * Time: 17:23
 */

error_reporting(E_ALL); ini_set('display_errors', '1');
/** system_header
 *  contains all project headers */

/* Header Files */
require_once __DIR__ . "/viewHeader.php";

/* CLASSES: Required for plugin loading and configuration */
require_once __DIR__ . "/../../lib/SystemClasses/ConfigurationManager.php";
require_once __DIR__ . "/../../lib/SystemClasses/PluginLoader.php";
require_once __DIR__ . "/../../lib/SystemClasses/PluginBuilder.php";
require_once __DIR__ . "/../../lib/SystemClasses/PluginWriter.php";
require_once __DIR__ . "/../../lib/SystemClasses/PluginValidator.php";
require_once __DIR__ . "/../../lib/SystemClasses/TagBuilder.php";
require_once __DIR__ . "/../../lib/SystemClasses/TagRenderer.php";

/* CLASSES: Requires for HTML page loading */
require_once __DIR__ . "/../../lib/HtmlClasses/HtmlPageAbstract.php";
require_once __DIR__ . "/../../lib/HtmlClasses/HtmlPageCatBar.php";
require_once __DIR__ . "/../../lib/HtmlClasses/HtmlPageFooter.php";
require_once __DIR__ . "/../../lib/HtmlClasses/HtmlPageHeader.php";
require_once __DIR__ . "/../../lib/HtmlClasses/HtmlPageNavBar.php";
require_once __DIR__ . "/../../lib/HtmlClasses/HtmlPageRenderer.php";
require_once __DIR__ . "/../../lib/HtmlClasses/HtmlPageHead.php";
require_once __DIR__ . "/../../lib/HtmlClasses/HtmlPageClose.php";
require_once __DIR__ . "/../../lib/HtmlClasses/HtmlPageBuilder.php";
require_once __DIR__ . "/../../lib/HtmlClasses/HtmlPageTabBuilder.php";

/* CLASSES: Requires for DataSource page loading */
require_once __DIR__ . "/../../lib/DataSource/PdoSingleton.php";

error_reporting(E_ALL); ini_set('display_errors', '1');

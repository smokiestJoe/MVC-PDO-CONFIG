<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 25/05/2018
 * Time: 19:35
 */

use SystemClasses\ConfigurationManager;

/**
 * Class PluginWriter
 */
class PluginWriter extends ConfigurationManager
{
    /**
     * @var string
     */
    private $loadBootstrap = "";
    /**
     * @var string
     */
    private $loadJquery = "";
    /**
     * @var array
     */
    private $pluginArray = [];
    /**
     * @var array
     */
    private $negatedArray = [];
    /**
     * @var array
     */
    private $pairsArray = [];

    /**
     * PluginWriter constructor.
     * @param $loadBootstrap
     * @param $loadJquery
     */
    public function __construct($loadBootstrap , $loadJquery)
    {
        $this->loadBootstrap = trim($loadBootstrap);
        $this->loadJquery = trim($loadJquery);

        $this->pluginArray[] = $this->loadBootstrap;
        $this->pluginArray[] = $this->loadJquery;

        $this->processFile();
    }

    /**
     *
     */
    private function setStrings()
    {
        foreach ($this->pluginArray as $negation) {

            list($configKey, $configValue) = explode(":", $negation);

            if ($configValue == "TRUE") {

                $configValue = "FALSE";

            } elseif ($configValue == "FALSE") {

                $configValue = "TRUE";
            }

            $negated = $configKey . ":" .$configValue;

            $this->negatedArray[] = $negated;
        }

        $this->pairPluginStrings();
    }

    /**
     *
     */
    private function pairPluginStrings()
    {
        $this->pairsArray = array_combine($this->negatedArray, $this->pluginArray);
    }

    /**
     *
     */
    private function writeTextFile()
    {
        $this->setStrings();

        $reading = fopen($this->configurationDirectories['PluginsAjax'], 'r');

        $writing = fopen($this->configurationDirectories['PluginsAjax'] . '.tmp', 'w');

        while (!feof($reading)) {

            $line = fgets($reading);

            $line = trim($line);

            if(array_key_exists($line, $this->pairsArray)) {

                $line = $this->pairsArray[$line] . PHP_EOL;

                $replaced = true;
            }

            elseif ($line != ""){

                $line = $line . PHP_EOL;

                $replaced = true;
            }

            fputs($writing, $line);
        }

        fclose($reading);

        fclose($writing);

        if ($replaced) {

            rename($this->configurationDirectories['PluginsAjax'] . '.tmp', $this->configurationDirectories['PluginsAjax']);

        } else {

            unlink($this->configurationDirectories['PluginsAjax'] . '.tmp');
        }
    }

    /**
     *
     */
    private function setDatabaseValues()
    {
        $pdoConnection = PdoSingleton::Instance();

        $pluginVal = "";

        foreach ($this->pluginArray as $value) {

            list($configKey, $configValue) = explode(":", $value);

            if ($configValue == "TRUE") {

                $pluginVal = '1';

            } elseif ($configValue == "FALSE") {

                $pluginVal = '0';
            }

            $sqlStatement = $pdoConnection->pdoConnection->prepare('UPDATE Plugins SET plugin_value = ? WHERE plugin_name = ?');

            $sqlStatement->execute([$pluginVal, $configKey]);
        }

        $sqlStatement = null;
    }

    /**
     * @return mixed|void
     */
    public function processFile()
    {
        if ($_SESSION['data_source'] == "TEXTFILE") {
            $this->writeTextFile();
        }

        if ($_SESSION['data_source'] == "DATABASE") {
            $this->setDatabaseValues();
        }
    }
}

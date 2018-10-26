<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 03/05/2018
 * Time: 19:15
 */

use SystemClasses\ConfigurationManager;

/**
 * Class PluginLoader
 */
class PluginLoader extends ConfigurationManager
{
    /**
     * @var string
     */
    private $connectionType = "";

    /**
     * @var string
     */
    private $pluginSettingFile = "";

    /**
     *
     */
    private function openPluginTextFile()
    {
        $this->pluginSettingFile = fopen($this->configurationDirectories['Plugins'], "r");

        try {
            if (!$this->pluginSettingFile) {

                throw new Exception("FATAL ERROR CONFIG: FILE NOT FOUND");

            }
        } catch (Exception $e) {

            $e->getMessage();
        }
    }

    /**
     *
     */
    private function readPluginFileFromTextFile()
    {
        while (($currentLine = fgets($this->pluginSettingFile)) !== false) {

            list ($configKey, $configValue) = explode(":", $currentLine);

            $configKey = trim($configKey);

            $configValue = trim($configValue);

            if (array_key_exists($configKey, $this->configurationSettings['Plugins'])) {

                if ($configValue == "TRUE") {

                    $this->configurationSettings['Plugins'][$configKey] = true;

                } elseif ($configValue == "FALSE") {

                    $this->configurationSettings['Plugins'][$configKey] = false;

                } else {

                    die("Error Reading Plugin File -->");
                }
            }
        }

        fclose($this->pluginSettingFile);
    }

    /**
     *
     */
    private function readPluginFileFromDatabase()
    {
        $pdoConnection = PdoSingleton::Instance();

        $sqlStatement = $pdoConnection->pdoConnection->prepare('SELECT * FROM Plugins');

        $sqlStatement->execute();

        while ($row = $sqlStatement->fetch())
        {
            if (array_key_exists($row['plugin_name'], $this->configurationSettings['Plugins'])) {

                if ($row['plugin_value'] == '1') {

                    $this->configurationSettings['Plugins'][$row['plugin_name']] = true;
                }

            } elseif ($row['plugin_value'] == '0')  {

                $this->configurationSettings['Plugins'][$row['plugin_name']] = false;

            } else {

                die ("INVALID PLUGIN VALUE");
            }
        }

        $sqlStatement = null;
    }

    /**
     *
     */
    protected function processFile()
    {
        /* change to null for text file */
        /* TEMPORARY MEASURE */
        $pdoConnection = true;

        if ($pdoConnection == null) {

            $this->connectionType = "TEXTFILE";

        } else {

            $this->connectionType = "DATABASE";
        }

        if (!$_SESSION['set_config']) {

            $_SESSION['set_config'] = true;

            if ($this->connectionType == "TEXTFILE") {

                $this->openPluginTextFile();
                $this->readPluginFileFromTextFile();
                $_SESSION['data_source'] = "TEXTFILE";
            }

            if ($this->connectionType == "DATABASE") {

                $this->readPluginFileFromDatabase();
                $_SESSION['data_source'] = "DATABASE";
            }

            $_SESSION['configurationSettings'] = $this->configurationSettings;

            $validatePlugins = new PluginValidator($this->connectionType);

            $validatePlugins->processFile();
        }
    }
}

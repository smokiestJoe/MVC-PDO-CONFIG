<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 26/05/2018
 * Time: 18:31
 */

use SystemClasses\ConfigurationManager;

/**
 * Class PluginValidator
 */
class PluginValidator extends ConfigurationManager
{
    /**
     * @var string
     */
    public $validationType = "";

    /**
     * @return mixed|void
     */
    public function __construct($validationType)
    {
        $this->validationType = $validationType;
    }

    /**
     *
     */
    private function validatePluginTextFile()
    {
        $reading = fopen($this->configurationDirectories['Plugins'], 'r');

        $writing = fopen($this->configurationDirectories['Plugins'] . '.tmp', 'w');

        $replaced = false;

        while (!feof($reading)) {

            $line = fgets($reading);

            if (stristr($line, 'LOAD_JQUERY:FALSE')) {

                $line = "LOAD_JQUERY:TRUE\n";

                $replaced = true;
            }

            fputs($writing, $line);
        }

        fclose($reading);

        fclose($writing);

        if ($replaced) {

            rename($this->configurationDirectories['Plugins'] . '.tmp', $this->configurationDirectories['Plugins']);

        } else {

            unlink($this->configurationDirectories['Plugins'] . '.tmp');
        }
    }

    private function validatePluginDatabase()
    {
        $pdoConnection = PdoSingleton::instance();

        $sqlStatement = $pdoConnection->pdoConnection->prepare('UPDATE Plugins SET plugin_value =? WHERE plugin_name =?');

        $sqlStatement->execute(['1', "LOAD_JQUERY"]);

        $sqlStatement = null;
    }

    /**
     *
     */
    private function validate()
    {
        // RULES:
        /* CANT HAVE: BOOTSTRAP - WITHOUT THIS: JQUERY */

        if ($_SESSION['configurationSettings']['Plugins']['LOAD_BOOTSTRAP'] && !$_SESSION['configurationSettings']['Plugins']['LOAD_JQUERY']) {

            $_SESSION['configurationSettings']['Plugins']['LOAD_JQUERY'] = true;

            ?>
            <script>
                alert("Warning! You are attempting to run bootstrap js without " +
                    "jquery installed. This will result in error. Jquery has now been " +
                    "reactivated. Thank you.")
            </script>
            <?php

            if ($this->validationType == "TEXTFILE") {

                $this->validatePluginTextFile();
            }

            if ($this->validationType == "DATABASE") {

                $this->validatePluginDatabase();
            }

            $this->processFile();
        }
    }

    /**
     * @return mixed|void
     */
    public function  processFile()
    {
        $this->validate();
    }

}

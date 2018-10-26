<?php

/**
 * Class PluginBuilder
 */
class PluginBuilder extends PluginLoader
{
    /**
     * @var array
     */
    protected $fileArray = [];

    /**
     * @var array
     */
    public $config =[];

    /**
     *
     */
    protected function looping() {

        $this->processFile();

        if (! $_SESSION['set_config']) {

            $this->config = $this->configurationSettings;

        } else {

            $this->config = $_SESSION['configurationSettings'];
        }

        foreach ($this->config['Plugins'] as $loadCommand => $boolValue) {

            if ($boolValue) {

                foreach ($this->directoryArray[$loadCommand] as $directory => $htmlPlacement) {

                    $loadedFilesArray = scandir($directory);

                    foreach ($loadedFilesArray as $files) {

                        $files = trim($files);

                        if ($files != '.' && $files != '..') {

                            $files = $directory . $files;

                            $this->fileArray[$loadCommand][$files][] = $htmlPlacement;
                        }
                    }
                }

            } elseif (! $boolValue) {

                if (array_key_exists($loadCommand, $this->fileArray)) {

                    unset($this->fileArray[$loadCommand]);
                }

            } else {

                die("Died in the Plugin Builder -->");
            }

            unset ($this->config);

        }
    }
}

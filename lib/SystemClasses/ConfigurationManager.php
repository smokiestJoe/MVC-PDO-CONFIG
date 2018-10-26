<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 03/05/2018
 * Time: 19:15
 */

namespace SystemClasses;

/**
 * Class ConfigurationManager
 * @package SystemClasses
 */
abstract class ConfigurationManager
{
    /**
     * @var array
     */
    protected $configurationDirectories =
        [
            /* Though this is currently a text file,
            this will become a DB Connection in the next iteration*/
            'Plugins' => '../../lib/config/pluginSettings',
            'PluginsAjax' => '../../lib/config/pluginSettings',
        ];

    /**
     * @var array
     */
    protected $configurationSettings = [
        'Css' => [
            'LOAD_CSS' => false,
        ],
        'Plugins' => [
            'LOAD_BOOTSTRAP' => false,
            'LOAD_JQUERY' => false,
        ],
        'Script' => [
            'LOAD_JSCRIPT-USR' => false,
            'LOAD_JQUERY-USR' => false,
        ],
    ];

    /**
     * @var array
     */
    protected $directoryArray = [
        'LOAD_BOOTSTRAP' => [
            '../bootstrap/css/' => 'top',
            '../bootstrap/js/' => 'bottom',
        ],
        'LOAD_JQUERY' => [
            '../jquery/' => 'bottom',
        ],
    ];

    /**
     * @return mixed
     */
    abstract protected function processFile();
}

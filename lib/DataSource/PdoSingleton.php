<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 26/05/2018
 * Time: 23:27
 */

class PdoSingleton
{
    /**
     * @var string
     */
    private $dsn = 'mysql:dbname=JrFramework;host=127.0.0.1';

    /**
     * @var string
     */
    private $username = 'SmokiestJoe';

    /**
     * @var string
     */
    private $password = 'Starbug1';

    /**
     * @var
     */
    public $pdoConnection;

    /**
     * PdoSingleton constructor.
     */
    private function __construct()
    {
        $this->connect();
    }

    /**
     *
     */
    private function __clone()
    {
        // private - CANNOT CLONE INSTANCE
    }

    /**
     * @return null|PdoSingleton
     */
    public static function Instance()
    {
        static $inst = null;

        if ($inst === null) {

            $inst = new PdoSingleton();
        }

        return $inst;
    }

    /**
     *
     */
    private function connect()
    {
        try {

            $this->pdoConnection = new PDO($this->dsn, $this->username, $this->password);

        } catch (PDOException $e) {

            echo 'Connection to Database failed: ' . $e->getMessage();
        }
    }

}
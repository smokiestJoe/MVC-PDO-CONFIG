<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 19/05/2018
 * Time: 15:39
 */

/**
 * Class HtmlPageAbstract
 */
abstract class X_HtmlPageAbstract
{
    /**
     * @var string
     */
    private $VIEW_FILE_PATH = '../../src/views/';

    /**
     * @var string
     */
    private $VIEW_HEADER_FILE_PATH = '../../src/headers/viewHeader.php';

    /**
     * @var string
     */
    private $HTML_PAGES_PATH = '../pageusr/';

    /**
     * @var string
     */
    private $REQUIRE_COMMAND = 'include_once __DIR__ . "/../views/';

    /**
     * @var
     */
    protected $systemPlugins;

    /**
     * @var
     */
    protected $pageName;

    /**
     * @var
     */
    protected $title;

    /**
     * @var
     */
    protected $funcname;

    /**
     * @var
     */
    protected $view;

    /**
     * @var
     */
    protected $linkKey;

    /**
     * @var
     */
    protected $header;

    /**
     * @var
     */
    protected $footer;

    /**
     * @var array
     */
    public $catTabsLinks = [];

    /**
     * @var array
     */
    public $navTabsLinks = [];

    /**
     * @var array
     */
    public $sideBarLinks = [];

    /**
     * @var array
     */
    public $pages = [
      /*  'home' =>
            [
                'name' => 'home',
                'focus' => false,
                'title' => 'Welcome to the Homepage',
                'filename' => 'home.php',
                'funcname' => 'homeView',
                'viewname' => 'homeView.php',
                'cattabsname' => 'Home',
                'showcattab' => true,
                'shownavtab' => false,
                'showsidebar' => false,
                'header' => 'DEFAULT HOME PAGE HEADER',
                'footer' => null,
            ],
        'page1' =>
            [
                'name' => 'page1',
                'focus' => false,
                'title' => 'Welcome to Page One',
                'filename' => 'page1.php',
                'funcname' => 'page1View',
                'viewname' => 'page1View.php',
                'cattabsname' => 'Page 1',
                'showcattab' => true,
                'shownavtab' => false,
                'showsidebar' => false,
                'header' => 'DEFAULT PAGE ONE HEADER',
                'footer' => null,
            ],
        'page2' =>
            [
                'name' => 'page2',
                'focus' => false,
                'title' => 'Welcome to Page Two',
                'filename' => 'page2.php',
                'funcname' => 'page2View',
                'viewname' => 'page2View.php',
                'cattabsname' => 'Page 2',
                'showcattab' => true,
                'shownavtab' => false,
                'showsidebar' => false,
                'header' => 'DEFAULT PAGE TWO HEADER',
                'footer' => null,
            ],
        'page3' =>
            [
                'name' => 'page3',
                'focus' => false,
                'title' => 'Welcome to Page Three',
                'filename' => 'page3.php',
                'funcname' => 'page3View',
                'viewname' => 'page3View.php',
                'cattabsname' => 'Page 3',
                'showcattab' => true,
                'shownavtab' => false,
                'showsidebar' => false,
                'header' => 'DEFAULT PAGE THREE HEADER',
                'footer' => null,
            ],*/
        ];

    protected function setHtmlTextFilePage($pageFocus)
    {
        foreach ($this->pages as $pageName => $v) {

            foreach ($this->pages[$pageName] as $property => $w) {

                /* Exclusive to the HTML Page in focus */
                if ($property == 'name') {

                    if ($this->pages[$pageName][$property] == $pageFocus) {

                        $this->pageName = $this->pages[$pageName]['name'];
                        $this->title = $this->pages[$pageName]['title'];
                        $this->funcname = $this->pages[$pageName]['funcname'];
                        $this->view = $this->pages[$pageName]['viewname'];
                        $this->header = $this->pages[$pageName]['header'];
                        $this->linkKey = $this->pages[$pageName]['filename'];
                    }
                }

                /* Project wide */
                if ($property == 'cattabsname') {

                    if($this->pages[$pageName]['showcattab']) {

                        $catKey = $this->pages[$pageName]['filename'];
                        $catVal = $this->pages[$pageName]['cattabsname'];

                        $this->catTabsLinks[] = [$catKey => $catVal];
                    }

                    if($this->pages[$pageName]['shownavtab']) {

                        $catKey = $this->pages[$pageName]['filename'];
                        $catVal = $this->pages[$pageName]['cattabsname'];

                        $this->navTabsLinks[] = [$catKey => $catVal];
                    }
                }

                if ($property == 'viewname') {

                    $fileName = $this->pages[$pageName][$property];
                    $func = $this->pages[$pageName]['funcname'];
                    $fileLocation = $this->VIEW_FILE_PATH . $fileName;

                    if (!file_exists($fileLocation)) {

                        /* 1/3 GENERATE PAGE VIEW */
                        if (!is_file($fileName)) {
                            /* Page Construction */
                            $newViewPageBuild = "                           
                               <?php
                                function $func()
                                {
                                    ?>
                                    <!-- This is where you put your HTML -->
                                                                    
                                    <?php
                                    /** This is where you put your PHP  **/
                                                                                            
                                    echo \"THIS IS THE {$this->pages[$pageName]['name']} VIEW\";                                                                                                                
                                }                                        
                            ";
                            file_put_contents($fileLocation, $newViewPageBuild);
                        }

                        /* 2/3 BUILDER HEADER & INSERT VIEW HEADER STRING */
                        $headerCommand = $this->REQUIRE_COMMAND . $this->pages[$pageName]['viewname']. '";';
                        file_put_contents($this->VIEW_HEADER_FILE_PATH, $headerCommand.PHP_EOL , FILE_APPEND | LOCK_EX);

                        /* 3/3 BUILD HTML PAGE */
                        $fileName = $this->pages[$pageName]['filename'];
                        $fileLocation = $this->HTML_PAGES_PATH . $fileName;

                        if (!file_exists($fileLocation)) {
                            $htmlPageName = $this->pages[$pageName]['name'];
                            $newHtmlPageBuild = '                                  
                            <?php
                            session_start();
                            require_once __DIR__ . "/../../src/headers/systemHeader.php";
                            error_reporting(E_ALL); ini_set(\'display_errors\', \'1\');
                            $htmlPage = new HtmlPageRenderer();
                            $htmlPage->render("';
                            $newHtmlPageBuild .= $htmlPageName;
                            $newHtmlPageBuild .= '");                                                                                                                                                                             
                            ';
                            file_put_contents($fileLocation, $newHtmlPageBuild);
                        }
                        else {
                            //      FILE DOES EXITS... CLEAN UP?";
                        }/* END PROTOTYPE */
                    } /* END CHECK FILE EXISTENCE */
                } /* END 'viewname' */
            } /* End For Each - Value */
        } /* End For Each - Key */
    }

    /**
     * @param $pageFocus
     */
    protected function setHtmlDbPage($pageFocus)
    {
        //$pageFocus = "GARY";

        $pdoConnection = PdoSingleton::Instance();

        $sqlStatement = $pdoConnection->pdoConnection->prepare("SELECT * FROM HtmlPages WHERE page_name = ?");

        $sqlStatement->execute([$pageFocus]);

        if ($sqlStatement->rowCount() == 0) {

            die("NO PAGE WAS FOUND - DIED BUILDING HTML PAGE");

        } else {

            /* For individual page displayed */
            while ($row = $sqlStatement->fetch()) {

                $this->pageName = $row['page_name'];
                $this->title = $row['page_title'];
                $this->linkKey = $row['page_filename'];
                $this->funcname = $row['page_function'];
                $this->view = $row['page_view_name'];
                $this->header = $row['page_header'];
                $this->footer = $row['page_footer'];
            }

            /* For pages in the whole project */
            $sqlStatement = $pdoConnection->pdoConnection->query("SELECT * FROM HtmlPages");

            while ($row = $sqlStatement->fetch())
            {
                if ($row['page_show_cat'] == '1') {

                    $catKey = $row['page_filename'];
                    $catVal = $row['page_tabs_name'];

                    $this->catTabsLinks[] = [$catKey => $catVal];
                }

                if ($row['page_show_nav'] == '1') {

                    $catKey = $row['page_filename'];
                    $catVal = $row['page_tabs_name'];

                    $this->navTabsLinks[] = [$catKey => $catVal];
                }

                if ($row['page_show_side'] == '1') {

                    $catKey = $row['page_filename'];
                    $catVal = $row['page_tabs_name'];

                    $this->sideBarLinks[] = [$catKey => $catVal];
                }

                if ($row['page_name'] != "home") {

                    $fileName = $row['page_view_name'];
                    $func = $row['page_function'];
                    $fileLocation = $this->VIEW_FILE_PATH . $fileName;

                    if (!file_exists($fileLocation)) {

                        /* 1/3 GENERATE PAGE VIEW */
                        if (!is_file($fileName)) {
                            /* Page Construction */
                            $newViewPageBuild = "                           
                               <?php
                                function $func()
                                {
                                    ?>
                                    <!-- This is where you put your HTML -->
                                                                    
                                    <?php
                                    /** This is where you put your PHP  **/
                                                                                            
                                    echo \"THIS IS THE {$row['page_name']} VIEW\";                                                                                                                
                                }                                        
                            ";
                            file_put_contents($fileLocation, $newViewPageBuild);
                        }

                        /* 2/3 BUILDER HEADER & INSERT VIEW HEADER STRING */
                        $headerCommand = $this->REQUIRE_COMMAND . $row['page_view_name'] . '";';
                        file_put_contents($this->VIEW_HEADER_FILE_PATH, $headerCommand . PHP_EOL, FILE_APPEND | LOCK_EX);

                        /* 3/3 BUILD HTML PAGE */
                        $fileName = $row['page_filename'];
                        $fileLocation = $this->HTML_PAGES_PATH . $fileName;

                        if (!file_exists($fileLocation)) {
                            $htmlPageName = $row['page_name'];
                            $newHtmlPageBuild = '                                  
                            <?php
                            session_start();
                            require_once __DIR__ . "/../../src/headers/systemHeader.php";
                            error_reporting(E_ALL); ini_set(\'display_errors\', \'1\');
                            $htmlPage = new HtmlPageRenderer();
                            $htmlPage->render("';
                            $newHtmlPageBuild .= $htmlPageName;
                            $newHtmlPageBuild .= '");                                                                                                                                                                             
                            ';
                            file_put_contents($fileLocation, $newHtmlPageBuild);
                        }
                    }
                }
            }/** END WHILE */
        } /* END IF */

        $sqlStatement = null;
    }

    /**
     * @param $pageFocus
     */
    protected function setHtmlPage($pageFocus)
    {
        $this->systemPlugins = new TagRenderer();

        if ($_SESSION['data_source'] == "TEXTFILE") {

            $this->setHtmlTextFilePage($pageFocus);

        } elseif ($_SESSION['data_source'] == "DATABASE") {

            $this->setHtmlDbPage($pageFocus);
        }
    } /* End Function */
}

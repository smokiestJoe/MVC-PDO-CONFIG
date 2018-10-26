                                  
                            <?php
                            session_start();
                            require_once __DIR__ . "/../../src/headers/systemHeader.php";
                            error_reporting(E_ALL); ini_set('display_errors', '1');
                            $htmlPage = new HtmlPageRenderer();
                            $htmlPage->render("page3");                                                                                                                                                                             
                            
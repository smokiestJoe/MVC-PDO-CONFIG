<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 19/05/2018
 * Time: 17:18
 */

class HtmlPageCatBar extends HtmlPageAbstract
{
    /**
     * @param $catTabs
     */
    public function buildHtml($catTabs)
    {
        if ($this->pageName != 'home'){

            $prefix = "../pages/";

        } else {

            $prefix = "";
        }

        print "
            <div id='catBarWrapper'> ";

        if (!empty($catTabs)) {

            print "
               <ul id='catBarList'>
        ";
            foreach ($catTabs as $tab) {

                print "<li id='catBarTab'>" . $tab . "</li>";
            }

            print "
                    <li><button onclick=\"popitup('{$prefix}configPopup.php')\"</button>Config</li>
                </ul>     
        ";
        }

        print "     
            </div>
        ";
    }
}

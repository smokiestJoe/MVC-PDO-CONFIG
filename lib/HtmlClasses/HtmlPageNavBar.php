<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 19/05/2018
 * Time: 17:17
 */

class HtmlPageNavBar
{
    public function buildHtml($navTabs)
    {
        print "
            <div id='navBarWrapper'> ";

        if (!empty($navTabs)) {

            print "
               <ul id='navBarList'>
        ";
            foreach ($navTabs as $tab) {

                print "<li id='navBarTab'>" . $tab . "</li>";
            }

            print "
                </ul>
        ";
        }

        print "
            </div>
        ";
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 19/05/2018
 * Time: 17:18
 */

class HtmlPageHeader extends HtmlPageAbstract
{
    public function buildHtml($header)
    {
        print "
            <header>$header</header>  
        ";
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 19/05/2018
 * Time: 17:30
 */

class HtmlPageRenderer extends HtmlPageAbstract
{
    public function render($pageFocus)
    {
        $builtPage = new HtmlPageBuilder();
        $builtPage->builtHtmlPage($pageFocus);
    }
}

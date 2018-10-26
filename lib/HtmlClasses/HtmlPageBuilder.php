<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 20/05/2018
 * Time: 20:53
 */

class HtmlPageBuilder extends HtmlPageAbstract
{
    /**
     * @param $pageFocus
     */
    public function builtHtmlPage($pageFocus)
    {
        $this->setHtmlPage($pageFocus);

        /**/
        $pageHead = new HtmlPageHead();

        $pageHead->buildHtml($this->systemPlugins, $this->title);

        /**/
        $tabsBuilder = new HtmlPageTabBuilder();

        $tabsBuilder->tabBuilder($this->catTabsLinks, $this->navTabsLinks, $this->linkKey);

        /**/
        $navigationBar = new HtmlPageNavBar();

        $navigationBar->buildHtml($tabsBuilder->getNavLinks());

        /**/
        $categoryBar = new HtmlPageCatBar();

        $categoryBar->buildHtml($tabsBuilder->getCatLinks());

        /**/
        $HeaderTag = new HtmlPageHeader();

        $HeaderTag->buildHtml($this->header);

        /**/
        call_user_func($this->funcname);

        /**/
        $footer = new HtmlPageFooter();

        $footer->buildHtml();

        /**/
        $close = new HtmlPageClose();

        $close->buildHtml($this->systemPlugins);
    }
}

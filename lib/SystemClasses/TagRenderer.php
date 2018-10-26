<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 19/05/2018
 * Time: 11:47
 */

class TagRenderer extends TagBuilder
{
    /**
     * @var array
     */
    private $renderArray = [];

    /**
     * TagRenderer constructor.
     */
    public function __construct()
    {
        parent::reverseTagArrays();
    }

    /**
     *
     */
    public function renderSystemHeadTags()
    {
        foreach ($this->tagsForHead as $loadCommand => $b) {

            foreach ($this->tagsForHead[$loadCommand] as $tag) {

                $this->dealWithBootstrap($tag);
            }
        }
        $this->render(true);
    }

    /**
     *
     */
    public function renderSystemBodyTags()
    {
        foreach ($this->tagsForBody as $loadCommand => $b) {

            foreach ($this->tagsForBody[$loadCommand] as $tag) {

                $this->dealWithBootstrap($tag);
            }
        }
        $this->render();
    }

    /**
     * @param $tag
     */
    private function dealWithBootstrap($tag)
    {
        /* Rules for dealing with specific file
        includes due to dependencies */
        if (!strpos($tag, '.map') && !strpos($tag, '.min')) {

            $this->renderArray[] = $tag;
        }
    }

    /**
     * @param bool $reversal
     */
    private function render($reversal = false)
    {
        if ($reversal) {
            $this->renderArray = array_reverse($this->renderArray);
        }

        if(! empty($this->renderArray)) {

            foreach ($this->renderArray as $p => $tag) {

                echo $tag;
            }
        }
        unset($this->renderArray);
    }
}

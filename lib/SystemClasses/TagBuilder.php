<?php

/**
 * Class TagBuilder
 */
class TagBuilder extends PluginBuilder
{
    /**
     * @var array
     */
    protected $tagsForHead = [];

    /**
     * @var array
     */
    protected $tagsForBody = [];

    /**
     * @var string
     */
    protected $tag = "";

    /**
     * @var string
     */
    private $SCRIPT_TAG_START = '<script src="';

    /**
     * @var string
     */
    private $SCRIPT_TAG_END = '"type="text/javascript"></script>';

    /**
     * @var string
     */
    private $CSS_TAG_START = '<link rel="stylesheet" type ="text/css" href="';

    /**
     * @var string
     */
    private $CSS_TAG_END = '">';

    /**
     *
     */
    private function prepareTags()
    {
        $this->looping();

        foreach ($this->fileArray as $loadCommand => $fileString) {


            foreach ($this->fileArray[$loadCommand] as $fileString => $w) {

                if (strpos($fileString, 'css')) {

                    $this->tag = $this->CSS_TAG_START . $fileString . $this->CSS_TAG_END;

                }  elseif (strpos($fileString, 'js')) {

                    $this->tag = $this->SCRIPT_TAG_START . $fileString . $this->SCRIPT_TAG_END;
                }

                foreach ($this->fileArray[$loadCommand][$fileString] as $htmlPlacement) {

                    if ($htmlPlacement == "top") {

                        $this->tagsForHead[$loadCommand][] = $this->tag;

                    } elseif ($htmlPlacement == "bottom") {

                        $this->tagsForBody[$loadCommand][] = $this->tag;

                    } else {

                        die ("Died In Tag Builder -->");
                    }
                }
            }
        }

        $this->tag = "";
    }

    /**
     *
     */
    protected function reverseTagArrays()
    {
        $this->prepareTags();

        $this->tagsForHead = array_reverse($this->tagsForHead);
        $_SESSION['head_tags'] = $this->tagsForHead;

        $this->tagsForBody = array_reverse($this->tagsForBody);
        $_SESSION['body_tags'] = $this->tagsForHead;

    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 26/05/2018
 * Time: 13:03
 */

class HtmlPageTabBuilder extends HtmlPageAbstract
{
    /**
     * @var array
     */
    private $navLinksArry = [];

    /**
     * @var array
     */
    private $catLinksArry = [];

    /**
     * @var array
     */
    private $sideLinksArry = [];

    /**
     * @var array
     */
    private $mergeArray = [
        'nav' => [

        ],
        'cat' => [

        ],
        'side' => [

        ]
    ];

    /**
     * @param $catTabArray
     * @param $navTabArray
     * @param $linkKey
     */
    public function tabBuilder($catTabArray, $navTabArray, $linkKey)
    {

        $this->mergeArray['nav'] = $navTabArray;

        $this->mergeArray['cat'] = $catTabArray;

        foreach ($this->mergeArray as $linkType => $array) {

            foreach ($this->mergeArray[$linkType] as $k => $v) {

                foreach ($this->mergeArray[$linkType][$k] as $fileName => $tabName) {

                    if ($fileName != $linkKey) {

                        if($fileName != 'home.php') {

                            $strBuffer = "<a class = \"catLinks\" href = \"../pageusr/$fileName\">{$tabName}</a>";

                        } else {

                            $strBuffer = "<a class = \"catLinks\" href = \"../pages/$fileName\">{$tabName}</a>";
                        }
                    }

                    else {

                        $strBuffer = "<a class = \"catLinks\" href = \"\">{$tabName}</a>";
                    }

                    if ($linkType == 'nav') {

                        $this->navLinksArry[] = $strBuffer;

                    } elseif ($linkType == 'cat') {

                        $this->catLinksArry[] = $strBuffer;

                    } elseif ($linkType == 'side') {

                        $this->sideLinksArry[] = $strBuffer;

                    } else {

                        die("ERROR - DIED IN TAB BUILDER");
                    }
                }
            }
        }
    }

    /**
     * @return array
     */
    public function getNavLinks()
    {
        return $this->navLinksArry;
    }

    /**
     * @return array
     */
    public function getCatLinks()
    {
       return $this->catLinksArry;
    }

    /**
     *
     */
    public function getSideLinks()
    {

    }
}

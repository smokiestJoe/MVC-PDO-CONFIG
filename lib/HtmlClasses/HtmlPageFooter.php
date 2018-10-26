<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 19/05/2018
 * Time: 17:19
 */

class HtmlPageFooter extends HtmlPageAbstract
{
    /**
     *
     */
    public function buildHtml()
    {
        print "
            <footer>
                <div id='footerDate'>
                    <p>
                        <?php echo date('d/m/y'); ?>
                    </p>
                </div>
            </footer>
       ";
    }
}

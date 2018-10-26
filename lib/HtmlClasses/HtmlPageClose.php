<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 19/05/2018
 * Time: 23:04
 */

class HtmlPageClose extends HtmlPageAbstract
{
    /**
     * @param $plugin
     */
    public function buildHtml($plugin)
    {
        $plugin->renderSystemBodyTags();

        print "
            <script language=\"javascript\" type=\"text/javascript\">
           
            function popitup(url) {
            
                newwindow=window.open(url,'name','height=500,width=600');
                
                if (window.focus) {newwindow.focus()}
                
                return false;
            }      
            
            </script>     
            </body>
        </html>    
        ";
    }
}

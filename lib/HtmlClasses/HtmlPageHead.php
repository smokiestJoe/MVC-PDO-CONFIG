<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 19/05/2018
 * Time: 23:04
 */

class HtmlPageHead extends HtmlPageAbstract
{
    public function buildHtml($plugin, $title)
    {
        print "
        <!DOCTYPE html>
        <html>       
            <head>
                <!-- Set Charset -->
                
                <meta charset='utf-8'/>
                
                <!-- Name of Page -->
                <!-- ** POTENTIALLY ADD INTELLIGENCE TO TITLE -->
            
                <title>$title</title>
                
                <!-- Basic Metadata, larger projects include keywords for SEO -->
                
                <meta name=\"description\" content=\"The HTML5 Herald\"/>
                <meta name=\"author\" content=\"SitePoint\"/>
                
                <link rel=\"stylesheet\" type=\"text/css\" href=\"../css/native.css\">     
        ";

        /** WRITES THE PLUGIN HEAD TAGS.
         * CONFIGURED: Bootstrap 4.0 - CSS */
        $plugin->renderSystemHeadTags();

        print"                                                                                    
            </head>
             <body>
                  
         ";
    }
}

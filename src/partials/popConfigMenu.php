<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 24/05/2018
 * Time: 21:19
 */

session_start();

error_reporting(E_ALL); ini_set('display_errors', '1');

print "SYSTEM MENU<br><br>";

print "EDIT PAGE<br>CLEAN UP(REMOVAL)<br>(Perhaps make clean up a mutually called function for ADD and REMOVE)<br>";

$pluginFormHtml = "";

function fieldsetPlugins()
{
    $pluginFormHtml = "

    <fieldset>
    
        <legend>Plugin Options:</legend>
    ";

    foreach ($_SESSION['configurationSettings']['Plugins'] as $pluginName => $pluginValue) {

        $checkboxValue = strtolower($pluginName);

        list($configKey, $configValue) = explode("_", $checkboxValue);

        $title = ucfirst($configValue);

        if ($pluginValue) {

            $is_loaded_checked = "checked";

        } else {

            $is_loaded_checked = "";
        }

        $pluginFormHtml .= "Include {$title}: <input type=\"checkbox\" name=\"{$checkboxValue}\" value=\"{$pluginName}\" {$is_loaded_checked} ><br>";
    }
    $pluginFormHtml .= "

    </fieldset>
    
    ";
    return $pluginFormHtml;
}

?>
<form name="pluginForm" id="pluginForm" method ="post">

    <fieldset>

        <legend>Pages:</legend>

        Add a Page: <input type="radio"><br>

        Remove a Page: <input type="radio"><br>

    </fieldset>

    <?php

        echo fieldsetPlugins();

    ?>

    <fieldset>

        <input id="pluginSubmit" type="submit">

    </fieldset>

    <fieldset>

        <button id="popupExit" type="close">Close Window</button>

    </fieldset>

</form>

<script>

    /* Submit Plugin Button */
    $( "#pluginSubmit" ).click(function() {
        SubForm();
        refreshParent();
    });
    $( "#popupExit" ).click(function() {
        self.close();
    });


    /* Submit Form without redirect */
    function SubForm (){
        $.ajax({
            url:'../../src/ajax/pluginPost.php',
            type:'post',
            data:$ ('#pluginForm').serialize(),
            success:function(){
              alert("Changes were made.");
            }
        });
    }

    /* Submit Form without redirect */
    function refreshParent() {

        window.opener.location.reload();
    }

</script>

<?php

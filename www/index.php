<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 22/04/2018
 * Time: 15:27
 */

session_start();

$_SESSION['set_config'] = false;

error_reporting(E_ALL); ini_set('display_errors', '1');

header("Location: pages/home.php");

?>
    <script src="jquery/jquery-3.3.1.js" type="text/javascript">

    $(document).ready(function(){

        $.ajax({ url: "home.php",

            type: get,

            context: document.body,

            success: function(){

                alert("done");

            }});
    });

</script>

<?php

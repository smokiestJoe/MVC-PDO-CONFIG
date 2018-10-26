<?php

session_start();

?>
    <div id = "viewDiv"> AJAX CONTENT HERE </div>

    <script src="../jquery/jquery-3.3.1.js" type="text/javascript"></script>

    <script language="javascript" type="text/javascript"></script>

    <script>

        $(document).ready(function(){

            $("#viewDiv").load("../../src/partials/popConfigMenu.php");
        });

    </script>

<?php

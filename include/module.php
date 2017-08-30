<?php

    function loadModules($module_name){
        global $base_uri;
        include($base_uri . "module/" . $module_name . ".php");
        return "";
    }

?>
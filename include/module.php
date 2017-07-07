<?php

    function loadModules($module_name){
        include("module/" . $module_name . ".php");
        return "";
    }

?>
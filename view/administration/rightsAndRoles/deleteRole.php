<?php

deleteRole($_GET['deleteRole']);
header('Location: index.php?page=administration&rightsAndRoles&listRoles=1');
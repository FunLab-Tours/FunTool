<?php
deleteProjectCategoryIncludeIn($_GET['idDeleteProjectCategory']);
deleteProjectCategory($_GET['idDeleteProjectCategory']);
header('Location: index.php?page=project&listProjectCategory=0');

?>
<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 18/08/2017
 * Time: 14:44
 */

loadModules("knowledges/softwareCategories");
loadModules("knowledges/softwares");
loadModules("knowledges/knowledges");

include("static/menu.php");

/*SOFTWARES CATEGORIES*/
if(isset($_GET['categories']))
    include("software/softwareCategories.php");
else if(isset($_GET['editCategory']))
    include("software/editCategory.php");
else if(isset($_GET['deleteCategory']))
    include("software/deleteCategory.php");
/*SOFTWARES SUBCATEGORIES*/
else if(isset($_GET['addSubCategory']))
    include("software/addSubCategory.php");
else if(isset($_GET['editSubCategory']))
    include("software/editSubCategory.php");
else if(isset($_GET['deleteSubCategory']))
    include("software/deleteSubCategory.php");
/*SOFTWARES*/
else if(isset($_GET['softwares']))
    include("software/softwares.php");
else if(isset($_GET['addSoftware']))
    include("software/addSoftware.php");
else if(isset($_GET['editSoftware']))
    include("software/editSoftware.php");
else if(isset($_GET['deleteSoftware']))
    include("software/deleteSoftware.php");
/*KNOWLEDGES*/
else if(isset($_GET['editKnowledge']))
    include("editKnowledge.php");
else if(isset($_GET['deleteKnowledge']))
    include("deleteKnowledge.php");
else
    include("knowledgeList.php");
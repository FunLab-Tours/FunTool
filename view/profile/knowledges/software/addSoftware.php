<?php

    if(isset($_POST['submit']) && $_POST['name'] != "" && $_POST['description'] != "" && isset($_POST['categories'])) {
        if(!isset($_POST['idSubCategories']))
            $subcat = array();
        else $subcat = $_POST['idSubCategories'];
            addSoftware($_POST['name'], $_POST['description'], $_POST['categories'], $subcat);

        //header('Location: index.php?page=profile&knowledge=0&softwares=0');
    }

?>

<form method = "POST" action = "">
    <input type = "text" placeholder="<?=$lang['softwareName']?>" name="name"/>
    <input type = "text" placeholder="<?=$lang['softwareDescription']?>" name="description"/>
    <select id ="categories" name ="categories[]" multiple onchange="updateSubList()">
        <option value="" selected="selected"><?=$lang['categories']?></option>
        <?php foreach(listCategories() as $category){?>
            <option value="<?=$category['idSoftCat']?>"><?=$category['categoryLabel']?></option>
        <?php } ?>
    </select>
    <div id="idSubCategories" name="idSubCategories"></div>
    <input type="submit" value="<?=$lang["addSoftware"]?>" name="submit">
</form>


<script>
    function updateSubList() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("idSubCategories").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "requests/subCategories.php?categories="+getCategories(),false);
        xmlhttp.send(null);
    }

    function getCategories()
    {
        var list = document.getElementById("categories");
        var lsSelections = "";
        for(var i=0; i<list.options.length; i++)
        {
            if(list.options[i].selected)
            {
                lsSelections += list.options[i].value + ";";
            }
        }
        return lsSelections;
    }
    list = document.getElementById("categories")
    for(var i=0; i<list.options.length; i++)
        console.log(list.options[i]);
</script>
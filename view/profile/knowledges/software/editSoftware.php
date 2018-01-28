<?php

    if(isset($_POST['submit']) && $_POST['name'] != "" && $_POST['description'] != "" && isset($_POST['categories']) && isset($_POST['idSubCategories'])) {
        editSoftware($_GET['editSoftware'], $_POST['name'], $_POST['description'], $_POST['categories'], $_POST['idSubCategories']);
        header('Location: index.php?page=profile&knowledge=0&softwares=0');
    }

    $softEdit = getSoftWare($_GET['editSoftware']);

?>

<form method = "POST" action = "">
    <input type = "text" value="<?=$softEdit['softwareName']?>" name="name"/>
    <input type = "text" value="<?=$softEdit['softwareDescription']?>" name="description"/>
    <select id ="categories" name ="categories[]" multiple onchange="updateSubList()">
        <?php $softwareCategories = getSoftwareCategories($_GET['editSoftware']);
            foreach($softwareCategories as $category){?>
            <option selected value="<?=$category['idSoftCat']?>"><?=$category['categoryLabel']?></option>
        <?php } ?>
        <?php foreach(listCategories() as $category) {
            if (!in_array($category, $softwareCategories)) { ?>
                <option value="<?= $category['idSoftCat'] ?>"><?= $category['categoryLabel'] ?></option>
            <?php }
        }?>
    </select>
    <div id="idSubCategories" name="idSubCategories"></div>
    <input type="submit" value="<?=$lang["edit"]?>" name="submit">
</form>


<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang['softwareName']?></td>
        <td><?=$lang['softwareDescription']?></td>
        <td><?=$lang['categories']?></td>
        <td><?=$lang['subCategories']?></td>
    </tr>
    <?php foreach(listSoftware() as $software) { ?>
            <tr>
                <td><?= $software['softwareName'] ?></td>
                <td><?= $software['softwareDescription'] ?></td>
                <td>
                    <?php foreach (getSoftwareCategories($software['idSoftware']) as $category) {
                        echo $category['categoryLabel'] . " ; ";
                    } ?>
                </td>
                <td>
                    <?php foreach (getSoftwareSubCategories($software['idSoftware']) as $subCategory) {
                        echo $subCategory['SubcatLabel'] . " ; ";
                    } ?>
                </td>

                <?php if ($software['idSoftware'] != $_GET['editSoftware']) { ?>
                    <td>
                        <a href="?page=profile&knowledge=1&editSoftware=<?= $software['idSoftware'] ?>"><?= $lang['edit'] ?></a>
                        | <a href="?page=profile&knowledge=1&deleteSoftware=<?= $software['idSoftware'] ?>"
                             onClick="return confirm('Are you sure you want to delete?')"><?= $lang['delete'] ?></a>
                    </td>
                <?php } ?>
            </tr>
    <?php } ?>
</table>


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
    updateSubList()
</script>
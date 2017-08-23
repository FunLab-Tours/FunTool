<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 21/08/2017
 * Time: 15:43
 */
?>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang['softwareName']?></td>
        <td><?=$lang['softwareDescription']?></td>
        <td><?=$lang['categories']?></td>
        <td><?=$lang['subCategories']?></td>
    </tr>
    <?php foreach(listSoftware() as $software){ ?>
        <td><?=$software['softwareName']?></td>
        <td><?=$software['softwareDescription']?></td>
        <td>
            <?php foreach(getSoftwareCategories($software['idSoftware']) as $category){
                echo $category['categoryLabel'];
            }?>
        </td>
        <td>
            <?php foreach(getSoftwareSubCategories($software['idSoftware']) as $subCategory){
                echo $subCategory['SubcatLabel'];
            }?>
        </td>
    <?php } ?>
    <tr>
        <form method = "POST" action = "">
            <td><input type = "text" placeholder="<?=$lang['softwareName']?>" name="name"/></td>
            <td><input type = "text" placeholder="<?=$lang['softwareDescription']?>" name=description"/></td>
            <td>
                <select name ="categories" multiple onchange="updateSubList(this.value)">
                    <option value="" selected="selected"><?=$lang['categories']?></option>
                    <?php foreach(listCategories() as $category){?>
                        <option value="<?=$category['idSoftCat']?>"><?=$category['categoryLabel']?></option>
                    <?php } ?>
                </select>
            </td>
            <td id="idSubCategories" name ="idSubCategories[]"></td>
            <td><input type="submit" value="<?=$lang["addSoftware"]?>" name="submit"></td>
        </form>
    </tr>
</table>


<script>
    function updateSubList(str) {
        if(str == "") {
            document.getElementById("idSubFamily").innerHTML = "";
            return;
        }
        else
        {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("idSubCategories").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "requests/subCategories.php?categories="+str,false);
            xmlhttp.send(null);
        }
    }
</script>
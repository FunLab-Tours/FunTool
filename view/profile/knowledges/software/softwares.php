<div>
    <a href="?page=profile&knowledge=1&addSoftware=1"><?=$lang["addSoftware"]?></a>
</div>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang['softwareName']?></td>
        <td><?=$lang['softwareDescription']?></td>
        <td><?=$lang['categories']?></td>
        <td><?=$lang['subCategories']?></td>
    </tr>
    <?php foreach(listSoftware() as $software){ ?>
        <tr>
            <td><?=$software['softwareName']?></td>
            <td><?=$software['softwareDescription']?></td>
            <td>
                <?php foreach(getSoftwareCategories($software['idSoftware']) as $category){
                    echo $category['categoryLabel'] . " ; ";
                }?>
            </td>
            <td>
                <?php foreach(getSoftwareSubCategories($software['idSoftware']) as $subCategory){
                    echo $subCategory['SubcatLabel'] . " ; ";
                }?>
            </td>
            <td>
                <a href="?page=profile&knowledge=1&editSoftware=<?=$software['idSoftware']?>"><?=$lang['edit']?></a>
                | <a href="?page=profile&knowledge=1&deleteSoftware=<?=$software['idSoftware']?>" onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a>
            </td>
        </tr>
    <?php } ?>
</table>
<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["login"]?></td>
        <td><?=$lang["firstName"]?></td>
        <td><?=$lang["name"]?></td>
        <td><?=$lang["email"]?></td>
        <td><?=$lang["endDateMembershipDate"]?></td>
        <td><?=$lang["paymentMethod"]?></td>
        <td><?=$lang["adminCommentary"]?></td>
        <td><?=$lang["frameName"]?></td>

    </tr>
</table>
<?php
    foreach(listAllMembership()as$row){
?>
<td><?=getUser($row['idUser'])['login']?></td>

<?php
    }
?>
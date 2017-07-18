<body>
    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["shortSumEvent"]?></td>
    </tr>

    <?php
        foreach(listAllEvent() as $row){
            echo "<tr>";
            echo "<td>".$row['shortSumEvent']."</td>";
        }
    ?>
    </table>
</body>

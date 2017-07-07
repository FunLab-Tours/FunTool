<?php
    include('functions.php');
    include('../../include/db.php');
    include('../../include/config.php');

        $query1=listAllLab();
        echo "<table><tr><td>Lab Name</td><td>Lab Description</td><td></td><td></td>";
            
            while($query2=mysql_fetch_array($query1))
                {
                    echo "<tr><td>".$query2['labName']."</td>";
                    echo "<td>".$query2['labDescription']."</td>";
                    echo "<td><a href='edit.php?id=".$query2['idLab']."'>Edit</a></td>";
                    echo "<td><a href='delete.php?id=".$query2['idLab']."'>x</a></td><tr>";
}

?>

</ol>
</table>
</body>
</html>
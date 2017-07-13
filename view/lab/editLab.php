<?php
    if(isset($_POST['submit']) && !empty($_POST['submit'])){
       updateLab($_GET['idEdit'],$_POST['labName'],$_POST['labDescription']);
       header('Location: index.php?page=lab');
       header('Location: index.php?page=lab');
    }
?>


<body>
    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["labName"]?></td>
        <td><?=$lang["labDescription"]?></td>
    </tr>
<?php
foreach (listAllLab() as $row ) { 
        if ($row['idLab']===$_GET['idEdit']) {  
            echo "<tr>";
            echo "<form action=\"\" method=\"post\">";
            echo "<td><input type=\"text\" name=\"labName\" value =".$row['labName']." />";
            echo "<td><input type=\"text\" name=\"labDescription\" value =".$row['labDescription']." />";   
            echo "<td><input type=\"submit\" value=\"submit\" name=\"submit\"> | <a href=\"index.php?page=lab\">Cancel</a>";
            
        }
        else{
            echo "<tr>";
            echo "<td>".$row['labName']."</td>";
            echo "<td>".$row['labDescription']."</td>"; 
            
                    
        }     
}
?>
    </table>
</body>
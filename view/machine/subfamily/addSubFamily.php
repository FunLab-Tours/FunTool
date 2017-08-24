<?php
if(isset($_POST['submit'])) {
    if(addSubFamily($_POST['codeSubFamily'],
        $_POST['labelSubFamily'],
        $_GET['add_subFamily']
    ))
        header('Location: index.php?page=machine&familyManagement=0');
}
?>

<body>
<form action="" method="post">
    <input type="text" placeholder="<?=$lang['subFamily_label']?>" name="labelSubFamily" />
    <input type="text" placeholder="<?=$lang['subFamily_code']?>" name="codeSubFamily" />
    <input type="submit" value="<?=$lang["submit"]?>" name="submit">
</form>
</body>
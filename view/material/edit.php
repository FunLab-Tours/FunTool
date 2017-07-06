<?php
    include('functions.php');

    if(isValidMaterialSubmit())
        editMaterial();
    else if(isset($_POST['submit']))
        echo "Error.";

?>

<form method="POST" action="">
    <select name="materialList">
        <?php
            $labels = getMaterialList();
            while($buffer = $labels->fetch()) {
                ?><option value="<?=$buffer['idMat']?>"><?=$buffer['labelMat']?></option><?php
            }
        ?>
</select>																	</br>
    <input type="text" placeholder="Label" name="label" />					</br>
    <input type="text" placeholder="Code" name="code" />					</br>
    <input type="number" placeholder="Price" name="price" min="1" max="50">	</br>
    <input type="text" placeholder="Doc link" name="docLink" />				</br>
    <input type="text" placeholder="Comment" name="comment" />				</br>
    <input type="submit" name="submit" value="submit" />
</form>

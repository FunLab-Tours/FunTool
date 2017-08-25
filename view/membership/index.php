<?php
loadModules("membership");
include("static/membershipMenu.php");
if(isset($_GET['listMembershipFrame'])) {
    include("listMembershipFrame.php");
}

else if(isset($_GET['addMembershipFrame'])){
    include("addMembershipFrame.php");
}

else if(isset($_GET['idFrameEdit'])){
    include("editMembershipFrame.php");
}

else if(isset($_GET['idFrameDelete'])){
    include("deleteMembershipFrame.php");
}
else if(isset($_POST['submitMembership'])){
    include("membershipInfoCheck.php");
}
else{
    include("addMembership.php");
}
?>
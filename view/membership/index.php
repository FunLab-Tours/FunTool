<?php
loadModules("membership");
// loadModules("event");
loadModules("user");
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
else if(isset($_POST['membershipPayed'])){
    include("paymentMembershipAccepted.php");
}
else if(isset($_GET['listMembership'])){
    include("listMembership.php");
}
else if(isset($_GET['idDeleteMembership'])){
    include("deleteMembership.php");
}
else if(isset($_GET['idEditMembership'])){
    include("editMembership.php");
}
else if(isset($_GET['adminAddMembership'])){
    include("adminAddMembership.php");
}
else{
    include("addMembership.php");
}
?>
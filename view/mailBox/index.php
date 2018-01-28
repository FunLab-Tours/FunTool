<?php

    loadModules("mailBox/message");
    loadModules("user");

    include("static/menu.php");

    if(isset($_GET['newConversation']))
        include("newConversation.php");
    else if(isset($_GET['conversation'])) {
        setReadMessage($_GET['conversation'], $_COOKIE['id']);
        include("conversation.php");
    }
    else if(isset($_GET['conversationOptions']))
        include("conversationOptions.php");
    else if(isset($_GET['send'])) {
        $idConversation = searchForConversation($_COOKIE['id'], $_GET['send']);
        header('Location: index.php?page=mailBox&conversation='.$idConversation);
    }
    else
        include("conversations.php");

?>
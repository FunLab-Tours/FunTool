<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 18/08/2017
 * Time: 14:52
 */

loadModules("mailBox/message");
loadModules("mailBox/conversation");
loadModules("user");

include("static/menu.php");

if(isset($_GET['newConversation']))
    include("newConversation.php");
else if(isset($_GET['conversation']))
    include("conversation.php");
else if(isset($_GET['conversationOptions']))
    include("conversationOptions.php");
else if(isset($_GET['send']))
{
    $idConversation = searchForConversation($_COOKIE['id'], $_GET['send']);
    header('Location: index.php?page=mailBox&conversation='.$idConversation);
}
else
    include("conversations.php");
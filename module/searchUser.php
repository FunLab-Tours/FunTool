<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 22/08/2017
 * Time: 15:06
 */

function allUser()
{
    global $DB_DB;
    return $DB_DB->query('SELECT * FROM User')->fetchAll();
}
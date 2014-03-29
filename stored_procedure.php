#!/usr/bin/env php
<?php
/**
 * Created by JetBrains PhpStorm.
 * User: balazs
 * Date: 2/8/14
 * Time: 3:20 AM
 * To change this template use File | Settings | File Templates.
 */

$db = new PDO("mysql:host=localhost;dbname=tanulas", "root", "vargabal");

goto sp_insert;

    $db->query('DROP PROCEDURE IF EXISTS selectUser;');
    $db->query('CREATE PROCEDURE selectUser() SELECT * FROM user;');

    $result = $db->query('CALL selectUser();');

    var_dump($result->fetchAll(PDO::FETCH_ASSOC));

sp_insert:

$db->query('DROP PROCEDURE IF EXISTS insertUser;');
$db->query('DELIMITER $$
    CREATE PROCEDURE insertUser(IN user STRING)
    BEGIN DECLARE uname STRING
    IF user = "balazs" uname = user + " king"
    ELSE uname = user

    INSERT INTO user(name) VALUES(uname)

    END$$
    DELIMITER ;');

$result = $db->query('CALL insertUser("balazs");');
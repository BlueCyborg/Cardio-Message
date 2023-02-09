<?php

// MESSAGE
function getMessageClub($idClub)
{
    global $wpdb;
    $query = $wpdb->prepare(
        "SELECT u.user_nicename,  m.`message`, m.`message_time` FROM `z00b_cardio-message` m INNER JOIN `z00b_users` u ON m.`id_user` = u.`ID` WHERE m.`id_club`= %d ORDER BY `message_time` ASC;",
        array($idClub)
    );
    return $wpdb->get_results($query);
}
function sendMessageClub($idClub, $idUser, $message)
{
    global $wpdb;
    $query = $wpdb->prepare(
        "INSERT INTO `z00b_cardio-message`(`id_club`, `id_user`, `message`) VALUES (%d, %d, %s)",
        array($idClub, $idUser, $message)
    );
    return $wpdb->get_results($query);
}

function getIdClub($pseudoClient)
{
    global $wpdb;
    $query = $wpdb->prepare(
        "SELECT `id_club` FROM `z00b_users` WHERE `user_nicename` = %s ",
        array($pseudoClient)
    );
    return $wpdb->get_results($query);
}

<?php

/**
 * Gestion de l'affichage administrateur
 */

function add_Admin_Link_3()
{
    add_menu_page(
        __('Cardio-Message', 'textdomain'),
        'Cardio-Message',
        'manage_options',
        'message',
        'cardioMessageMain',
        'dashicons-format-chat'
    );
}

function cardioMessageMain()
{
    include CM_FILE_PATH . 'vues/main.php';
}

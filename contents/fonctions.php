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
        'gestionMessage',
        'cardioMessageMain',
        'dashicons-format-chat'
    );

    add_submenu_page(
        'gestionMessage',
        'Messagerie',
        'Messagerie',
        'manage_options',
        'gestionMessage&option=messagerie',
        'cardioMessageMain'
    );
}

function cardioMessageMain()
{
    if (!isset($_GET['option'])) {
        //L'on inclu la page d'accueil par défaut
        include CM_FILE_PATH . 'vues/main.php';
    } else {

        switch ($_GET['option']) {
            //MAIN
            case 'accueil':
                include CM_FILE_PATH . 'vues/main.php';
                break;

            default:
                include CM_FILE_PATH . 'vues/main.php';
                break;
        }
    }
}

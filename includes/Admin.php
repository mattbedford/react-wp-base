<?php

namespace ReactBase\includes;

abstract class Admin
{

    public static function Init()
    {

        add_action('admin_notices', [self::class, 'add_sync_button']);
        add_action('admin_init', [self::class, 'handle_sync_button']);
        add_action('user_register', [self::class, 'sync_new_user_with_clienti_cpt']);
        add_action('manage_clienti_posts_custom_column', [self::class, 'custom_column_content'], 10, 2);
        add_filter('manage_clienti_posts_columns', [self::class, 'add_custom_columns']);
        add_action('admin_init', [self::class, 'reset_clienti_meta']);
        add_action('delete_user', [self::class, 'delete_clienti_cpt_on_user_delete']);
    }



// Crea il Custom Post Type per i Clienti
    public static function create_clienti_cpt()
    {
        $labels = array(
            'name' => 'Clienti',
            'singular_name' => 'Cliente',
            'menu_name' => 'Clienti',
            'name_admin_bar' => 'Cliente',
            'add_new' => 'Aggiungi Nuovo',
            'add_new_item' => 'Aggiungi Nuovo Cliente',
            'new_item' => 'Nuovo Cliente',
            'edit_item' => 'Modifica Cliente',
            'view_item' => 'Visualizza Cliente',
            'all_items' => 'Tutti i Clienti',
            'search_items' => 'Cerca Clienti',
            'not_found' => 'Nessun cliente trovato.',
            'not_found_in_trash' => 'Nessun cliente trovato nel cestino.'
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'custom-fields', 'author'),
            'show_in_rest' => false,
        );

        register_post_type('clienti', $args);
    }

// Registra la tassonomia "Categoria" per il Custom Post Type "Clienti"
    public static function create_categoria_taxonomy()
    {
        $labels = array(
            'name' => 'Categorie',
            'singular_name' => 'Categoria',
            'search_items' => 'Cerca Categorie',
            'all_items' => 'Tutte le Categorie',
            'parent_item' => 'Categoria Padre',
            'parent_item_colon' => 'Categoria Padre:',
            'edit_item' => 'Modifica Categoria',
            'update_item' => 'Aggiorna Categoria',
            'add_new_item' => 'Aggiungi Nuova Categoria',
            'new_item_name' => 'Nuovo Nome Categoria',
            'menu_name' => 'Categorie',
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'categoria'),
        );

        register_taxonomy('categoria', array('clienti'), $args);

        // Aggiungi i termini "padre" e "figli"
        if (!term_exists('Straordinaria', 'categoria')) {
            $straordinaria_id = wp_insert_term('Straordinaria', 'categoria');
            wp_insert_term('Bolle', 'categoria', array('parent' => $straordinaria_id['term_id']));
            wp_insert_term('Rapportini', 'categoria', array('parent' => $straordinaria_id['term_id']));
        }

        if (!term_exists('Ordinaria', 'categoria')) {
            $ordinaria_id = wp_insert_term('Ordinaria', 'categoria');
            wp_insert_term('Bolle', 'categoria', array('parent' => $ordinaria_id['term_id']));
            wp_insert_term('Rapportini', 'categoria', array('parent' => $ordinaria_id['term_id']));
        }
    }

// Aggiungi un bottone per la sincronizzazione nella pagina "Clienti"
    public static function add_sync_button()
    {
        $screen = get_current_screen();
        if ($screen->post_type == 'clienti') {
            echo '<a href="' . admin_url('edit.php?post_type=clienti&sync_users=1') . '" class="button button-primary">Sincronizza Utenti</a>';
        }
    }

// Sincronizza gli utenti quando il bottone viene premuto
    public static function handle_sync_button()
    {
        if (isset($_GET['sync_users']) && $_GET['sync_users'] == '1') {
            self::sync_admin_users_with_clienti_cpt();
            wp_redirect(admin_url('edit.php?post_type=clienti&synced=1'));
            exit;
        }
    }

// Sincronizza gli utenti di livello "administrator" con il Custom Post Type
    public static function sync_admin_users_with_clienti_cpt()
    {
        $args = array(
            'role' => 'any',
            'orderby' => 'user_nicename',
            'order' => 'ASC'
        );
        $users = get_users($args);
        foreach ($users as $user) {
            $user_id = $user->ID;
            $post_id = get_user_meta($user_id, 'clienti_post_id', true);
            if (!$post_id) {
                $post_id = wp_insert_post(array(
                    'post_title' => $user->user_nicename,
                    'post_type' => 'clienti',
                    'post_status' => 'publish',
                    'meta_input' => array(
                        'email' => $user->user_email,
                        'first_name' => get_user_meta($user_id, 'first_name', true),
                        'last_name' => get_user_meta($user_id, 'last_name', true),
                        'user_id' => $user_id
                    )
                ));
                update_user_meta($user_id, 'clienti_post_id', $post_id);
            }
        }
    }

// Sincronizza automaticamente durante la registrazione di un nuovo utente
    public static function sync_new_user_with_clienti_cpt($user_id)
    {
        $user = get_userdata($user_id);
        if (in_array('administrator', $user->roles)) {
            $post_id = wp_insert_post(array(
                'post_title' => $user->user_nicename,
                'post_type' => 'clienti',
                'post_status' => 'publish',
                'meta_input' => array(
                    'email' => $user->user_email,
                    'first_name' => get_user_meta($user_id, 'first_name', true),
                    'last_name' => get_user_meta($user_id, 'last_name', true),
                    'user_id' => $user_id
                )
            ));
            update_user_meta($user_id, 'clienti_post_id', $post_id);
        }
    }

// Elimina il post associato quando un utente viene eliminato
    public static function delete_clienti_cpt_on_user_delete($user_id)
    {
        $post_id = get_user_meta($user_id, 'clienti_post_id', true);
        error_log("Deleting user ID: $user_id, associated post ID: $post_id");
        if ($post_id) {
            wp_delete_post($post_id, true);
            error_log("Post ID $post_id deleted.");
        } else {
            error_log("No associated post found for user ID $user_id.");
        }
    }

// Funzione per resettare i meta dati degli utenti
    public static function reset_clienti_meta()
    {
        $args = array(
            'role' => 'administrator',
            'orderby' => 'user_nicename',
            'order' => 'ASC'
        );
        $users = get_users($args);
        foreach ($users as $user) {
            delete_user_meta($user->ID, 'clienti_post_id');
        }
    }

// Aggiungi una colonna personalizzata nella lista dei post del CPT "Clienti"
    public static function add_custom_columns($columns)
    {
        $columns['related_user'] = __('Utente Relazionato', 'text-domain');
        return $columns;
    }

// Popola la colonna con il nome utente associato e rendilo cliccabile
    public static function custom_column_content($column, $post_id)
    {
        if ($column == 'related_user') {
            $user_id = get_post_meta($post_id, 'user_id', true);
            if ($user_id) {
                $user = get_userdata($user_id);
                if ($user) {
                    $edit_user_link = get_edit_user_link($user_id);
                    echo '<a href="' . esc_url($edit_user_link) . '">' . esc_html($user->user_nicename) . '</a>';
                } else {
                    echo __('Utente non trovato', 'text-domain');
                }
            } else {
                echo __('Nessun utente associato', 'text-domain');
            }
        }
    }
}
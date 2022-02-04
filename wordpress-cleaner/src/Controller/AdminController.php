<?php

namespace Khaldalim\WordpressCleaner\Controller;

use Khaldalim\WordpressCleaner\WordpressCleaner;

class AdminController
{


    public function __construct()
    {
        $this->init_hooks();
    }

    public function init_hooks()
    {
        add_action('admin_menu', [$this, 'admin_menu']);
        add_action('admin_init', [$this, 'admin_init']);

    }

    //affiche un sous menu dans les reglages
    public function admin_menu()
    {
        add_options_page('Wordpress Cleaner', "Wordpress Cleaner", "manage_options", "wordpress_cleaner", [$this, "config_page"]);
    }


    public function config_page()
    {
        WordpressCleaner::render("config");
    }

    public function admin_init()
    {
        register_setting("wordpress_cleaner_general", "wordpress_cleaner_general");
        add_settings_section("wordpress_cleaner_main", null, null, "wordpress_cleaner");
        add_settings_field("remove_comments", "Supprimer les commentaires", [$this, "remove_comments"], 'wordpress_cleaner', "wordpress_cleaner_main");
        add_settings_field("remove_posts", "Supprimer les articles de base du wordpress", [$this, "remove_posts"], 'wordpress_cleaner', "wordpress_cleaner_main");
        add_settings_field("remove_widgets", "Supprimer les widgets inutiles", [$this, "remove_widgets"], 'wordpress_cleaner', "wordpress_cleaner_main");
        add_settings_field("remove_search", "Supprimer la recherche wordpress", [$this, "remove_search"], 'wordpress_cleaner', "wordpress_cleaner_main");
        add_settings_field("remove_apparance", "Supprimer le menu apparence (permet le choix du theme en cours)", [$this, "remove_apparance"], 'wordpress_cleaner', "wordpress_cleaner_main");
        add_settings_field("remove_tools", "Supprimer les outils d'import / export des données", [$this, "remove_tools"], 'wordpress_cleaner', "wordpress_cleaner_main");
        add_settings_field("remove_gutemberg", "Supprimer Gutemberg et passer sur l'éditeur classique", [$this, "remove_gutemberg"], 'wordpress_cleaner', "wordpress_cleaner_main");

    }

    public function remove_comments()
    {
        $general_options = get_option('wordpress_cleaner_general');
        if (isset($general_options['remove_comments'])) {
            $selectedValue = $general_options['remove_comments'];
        } else {
            $selectedValue = false;
        }
        echo '<input type="checkbox" name="wordpress_cleaner_general[remove_comments]"  value="1" ' . checked('1', $selectedValue, false) . '>';

    }


    public function remove_posts()
    {
        $general_options = get_option('wordpress_cleaner_general');

        if (isset($general_options['remove_posts'])) {
            $selectedValue = $general_options['remove_posts'];
        } else {
            $selectedValue = false;
        }

        echo '<input type="checkbox" name="wordpress_cleaner_general[remove_posts]"  value="1" ' . checked('1', $selectedValue, false) . '>';
    }


    public function remove_widgets()
    {


        $general_options = get_option('wordpress_cleaner_general');

        if (isset($general_options['remove_widgets'])) {
            $selectedValue = $general_options['remove_widgets'];
        } else {
            $selectedValue = false;
        }

        echo '<input type="checkbox" name="wordpress_cleaner_general[remove_widgets]"  value="1" ' . checked('1', $selectedValue, false) . '>';
    }

    public function remove_search()
    {
        $general_options = get_option('wordpress_cleaner_general');
        if (isset($general_options['remove_search'])) {
            $selectedValue = $general_options['remove_search'];
        } else {
            $selectedValue = false;
        }
        echo '<input type="checkbox" name="wordpress_cleaner_general[remove_search]"  value="1" ' . checked('1', $selectedValue, false) . '>';
    }




    public function remove_apparance()
    {
        $general_options = get_option('wordpress_cleaner_general');
        if (isset($general_options['remove_apparance'])) {
            $selectedValue = $general_options['remove_apparance'];
        } else {
            $selectedValue = false;
        }
        echo '<input type="checkbox" name="wordpress_cleaner_general[remove_apparance]"  value="1" ' . checked('1', $selectedValue, false) . '>';
    }



    public function remove_tools()
    {
        $general_options = get_option('wordpress_cleaner_general');
        if (isset($general_options['remove_tools'])) {
            $selectedValue = $general_options['remove_tools'];
        } else {
            $selectedValue = false;
        }
        echo '<input type="checkbox" name="wordpress_cleaner_general[remove_tools]"  value="1" ' . checked('1', $selectedValue, false) . '>';
    }


    public function remove_gutemberg()
    {
        $general_options = get_option('wordpress_cleaner_general');
        if (isset($general_options['remove_gutemberg'])) {
            $selectedValue = $general_options['remove_gutemberg'];
        } else {
            $selectedValue = false;
        }
        echo '<input type="checkbox" name="wordpress_cleaner_general[remove_gutemberg]"  value="1" ' . checked('1', $selectedValue, false) . '>';
    }


}

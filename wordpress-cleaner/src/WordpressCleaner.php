<?php

namespace Khaldalim\WordpressCleaner;

use Khaldalim\WordpressCleaner\Controller\AdminController;

class WordpressCleaner
{
    const TRANSIENT_WORDPRESS_CLEANER_ACTIVATED = "khaldalim_wordpress_cleaner";

    public function __construct(string $file)
    {
        register_activation_hook($file, [$this, 'plugin_activation']);
        add_action('admin_notices', [$this, 'notice_activation']);

        if (is_admin()) {
            $adminController = new AdminController();
        }
    }


    public function plugin_activation()
    {
        set_transient(self::TRANSIENT_WORDPRESS_CLEANER_ACTIVATED, true);
    }



    //Affiche un message a l'activation du plugin
    public function notice_activation()
    {
        if (get_transient(self::TRANSIENT_WORDPRESS_CLEANER_ACTIVATED)) {
            self::render('notices', [
                'message' => "Merci d'utiliser <strong>Wordpress Cleaner</strong> !"
            ]);
        }
        delete_transient(self::TRANSIENT_WORDPRESS_CLEANER_ACTIVATED);

    }



    public static function render(string $name, array $args = []): void
    {
        extract($args);

        $file = WORDPRESS_CLEANER_DIR . "views/$name.php";

        ob_start();

        include_once($file);

        echo ob_get_clean();
    }

}

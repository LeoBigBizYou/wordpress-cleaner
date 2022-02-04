<div class="wrap">
    <h1>Réglages Wordpress Cleaner</h1>

    <form method="post" action="options.php">
        <?php
        settings_fields("wordpress_cleaner_general");
        do_settings_sections('wordpress_cleaner');

        submit_button()




        ?>


    </form>
</div>

<?php
/** Remove Dashboard Widgets **/
function remove_draft_widget()
{
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');

    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');

}
add_action('wp_dashboard_setup', 'remove_draft_widget', 999);


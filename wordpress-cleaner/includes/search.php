<?php
function disable_search($query, $error = true)
{
    if (is_search()) {
        $query->is_search = false;
        $query->query_vars['s'] = false;
        $query->query['s'] = false;

        // to error

        if ($error == true) $query->is_404 = true;
    }
}

if (!is_admin()) {
    add_action('parse_query', 'disable_search');
    add_filter('get_search_form', function () {
        return null;
    });
}

<?php
// print menu item text field output in menu "a" tag inside
function add_acf_field_to_menu_items($menu_items) {
    if (!function_exists('get_field')) {
        return $menu_items;
    }

    foreach ($menu_items as $key => $menu_item) {
        $item_id = is_object($menu_item) ? $menu_item->ID : (isset($menu_item['ID']) ? $menu_item['ID'] : null);

        if ($item_id) {
            $menu_item_value = get_field('menu_item', $item_id);
            if ($menu_item_value) {
                $title = is_object($menu_item) ? $menu_item->title : (isset($menu_item['title']) ? $menu_item['title'] : '');
                $new_title = $title . ' <div class="custom-menu-text">' . esc_html($menu_item_value) . '</div>';
                
                if (is_object($menu_item)) {
                    $menu_item->title = $new_title;
                } else {
                    $menu_item['title'] = $new_title;
                }
            }
        }
    }
    return $menu_items;
}
add_filter('wp_nav_menu_objects', 'add_acf_field_to_menu_items');
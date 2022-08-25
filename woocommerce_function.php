<?php
// Display the cart item weight in cart and checkout pages
add_filter('woocommerce_get_item_data', 'display_custom_item_data', 10, 2);
function display_custom_item_data($cart_item_data, $cart_item)
{
    if ($cart_item['data']->get_weight() > 0) {
        $cart_item_data[] = array(
            'name' => __('Weight', 'woocommerce'),
            'value' => $cart_item['data']->get_weight() . ' ' . get_option('woocommerce_weight_unit')
        );
    }
    return $cart_item_data;
}


// CHANGE FLEXIBLE SHIPPING TOTAL WEIGHT CALCULATION


add_filter('flexible-shipping/condition/contents_weight', 'custom_cart_contents_weight', 10, 1);
function custom_cart_contents_weight($weight)
{
    global $coefficient;
    $items = array();
    foreach (WC()->cart->get_cart() as $cart_item) {
        // gets the product object
        $product            = $cart_item['data'];
        $product_weight_str = $product->get_weight() . " ";
        array_push($items, $product_weight_str);
    }
    $num_products = count($items);
    $heaviest_product =  max($items);
    $total_weight = $heaviest_product + (array_sum($items) - $heaviest_product) * $coefficient;
    $weight = $total_weight;
    return $weight;
}
$coefficient = 0.35;
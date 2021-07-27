<?php 

return [
    // 'site_name' => '',
    // 'site_logo' => '',
    'views' => [
        // 'components.header' => '',
        // 'components.breadcrumbs' => '',
    ],
    'header_menus' => [[
        'title' => 'lang.home',
        'url' => '/',
        'key' => 'home'
    ], [
        'title' => 'lang.products',
        'route' => 'products.index',
        'key' => 'product_index',
    ], [
        'title' => 'lang.contact',
        'url' => '/',
        'key' => 'contact'
    ]]
];
<?php
    function shopy_asset($path){
        return Shopy::asset($path);
    }

    function shopy_viewpath($path){
        return Shopy::viewPath($path);
    }
    
    function shopy_config($key, $default = null){
        return Shopy::config($key, $default);
    }

    function shopy_site_logo(){
        return Shopy::siteLogo();
    }

    function shopy_site_name(){
        return Shopy::siteName();
    }

    function shopy_trans($key, $default = ''){
        return Shopy::trans($key, $default);
    }

    function shopy_products($params = []){
        return Shopy::products($params);
    }

    function shopy_view($path, $params = []){
        return Shopy::view($path, $params);
    }
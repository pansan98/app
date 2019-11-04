<?php
    include_once __DIR__ . '/user/const.php';
    
    $options = [];
    foreach ($user_options as $name => $defined) {
        $options[$name] = $defined;
    }
    
    return $options;
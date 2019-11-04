<?php
    $rootHttp = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
    $rootHost = $_SERVER['HTTP_HOST'];
    $rootRoot = str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(__DIR__ . '/../../../'));
    $rootPath = $rootHttp . $rootHost . $rootRoot . '/';
    $rootDir = realpath(__DIR__ . '/../../../');
    
    $rootRelative = str_replace($rootHttp . $rootHost, "", $rootPath);
    
    $user_options = [
        'root_path' => $rootPath,
        'root_dir' => $rootDir . '/',
        'root_relative' => $rootRelative . 'administrator/',
        'admin_root_path' => $rootPath . 'administrator/public/',
        'admin_root_dir' => $rootDir . '/administrator/'
    ];
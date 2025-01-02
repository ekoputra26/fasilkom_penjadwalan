<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
if (!function_exists('backend_url')) {
  function backend_url($uri = '', $group = FALSE) {
    $CI = & get_instance();
    
    if (!$dir = $CI->config->item('assets_path')) {
        $dir = 'assets/backend/';
    }
    
    if ($group) {
        return $CI->config->base_url($dir . $group . '/' . $uri);
    } else {
        return $CI->config->base_url($dir . $uri);
    }
  }
}

if (!function_exists('frontend_url')) {
  function frontend_url($uri = '', $group = FALSE) {
    $CI = & get_instance();
    
    if (!$dir = $CI->config->item('assets_path')) {
        $dir = 'assets/frontend/';
    }
    
    if ($group) {
        return $CI->config->base_url($dir . $group . '/' . $uri);
    } else {
        return $CI->config->base_url($dir . $uri);
    }
  }
}

if (!function_exists('images_url')) {
  function images_url($uri = '', $group = FALSE) {
    $CI = & get_instance();
    
    if (!$dir = $CI->config->item('assets_path')) {
        $dir = 'assets/images/';
    }
    
    if ($group) {
        return $CI->config->base_url($dir . $group . '/' . $uri);
    } else {
        return $CI->config->base_url($dir . $uri);
    }
  }
}
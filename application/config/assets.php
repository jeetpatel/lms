<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$ark_root  = "http://".$_SERVER['HTTP_HOST'];
$ark_root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
$config['assets_url'] = $ark_root.'assets/';
$config['css_url'] = $ark_root.'assets/css/';
$config['js_url'] = $ark_root.'assets/js/';
$config['images_url'] = $ark_root.'assets/images/';
$config['bower_url'] = $ark_root.'assets/bower_components/';

/* End of file assets.php */
/* Location: ./application/config/assets.php */
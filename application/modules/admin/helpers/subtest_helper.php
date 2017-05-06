<?php
defined('BASEPATH') OR exit('No direct script access allowed.');
if(!function_exists('getSubTest')){
function getSubTest($test_id) {
  $CI =& get_instance();
  $CI->load->model('subtest_model','subtest_m');
  return $CI->subtest_m->get_all_subtest($test_id);
}
}

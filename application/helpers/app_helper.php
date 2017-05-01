<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('dump'))
{

	function dump()
	{

		list($callee) = debug_backtrace();


		$arguments = func_get_args();
		$total_arguments = count($arguments);
		echo '<fieldset style="background:#fefefe !important; border:2px red solid; padding:5px">' . PHP_EOL .
			'<legend style="background:lightgrey; padding:5px;">' . $callee['file'] . ' @ line: ' . $callee['line'] . '</legend>' . PHP_EOL .
			'<pre>';

	    $i = 0;
	    foreach ($arguments as $argument)
	    {
			echo '<br/><strong>Debug #' . (++$i) . ' of ' . $total_arguments . '</strong>: ';

			if ( (is_array($argument) || is_object($argument)) && count($argument))
			{
				print_r($argument);
			}
			else
			{
				var_dump($argument);
			}
		}

		echo '</pre>' . PHP_EOL .
			'</fieldset>' . PHP_EOL;
	}
}

if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}



if(!function_exists('array_from_post')){
	function array_from_post($fields){
		$CI =& get_instance();
        $data = array();
        foreach ($fields as $field) {
        	if(is_array($CI->input->post($field))){
        		$str = '';
        		foreach ($CI->input->post($field) as $key => $value) {
        			if($key != (count($CI->input->post($field)) - 1) )
        				$str .= $value.',';
        			else
        				$str .= $value;
        		}
        		$data[$field] = $str;	
        	}else{	
        		
        		$data[$field] = $CI->input->post($field);
        	}
            
        }
        return $data;
    }
}


if(!function_exists('breadCrumb')){
    function breadCrumb($data){

        $breadCrumb = '<ol class="breadcrumb">'.PHP_EOL;
        
        $i = 1;
        foreach ($data as $key => $value) {

            if(count($data) == $i)
                $breadCrumb .= '<li class="active">'.humanize($key).'</li>'.PHP_EOL;
            else
                $breadCrumb .= '<li><a href="'.$value.'">'.humanize($key).'</a></li>'.PHP_EOL;
            
            $i++;
        }

        $breadCrumb .= '</ol>'.PHP_EOL;

        return $breadCrumb;
            
    }
}



if(!function_exists('is_alphaNumeric')){
    function is_alphaNumeric($str){
        if(preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $str))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }    
}


if(!function_exists('rrmdir')){
     function rrmdir($dir) {
      if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
          if ($object != "." && $object != "..") {
            if (filetype($dir."/".$object) == "dir") 
               rrmdir($dir."/".$object); 
            else unlink   ($dir."/".$object);
          }
        }
        reset($objects);
        rmdir($dir);
      }
     }   
}


/* End of file ccc_helper.php */
/* Location: ./application/helpers/ccc_helper.php */
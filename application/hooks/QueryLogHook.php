<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* application/hooks/QueryLogHook.php */
class QueryLogHook {

    function log_queries() {   
      //  da('hi - query log path');
        $CI =& get_instance();
        $times = $CI->db->query_times;
        $dbs    = array();
        $output = NULL;    
        $queries = $CI->db->queries;

        if (count($queries) == 0)
        {
            $output .= "no queries\n";
        }
        else
        {
            foreach ($queries as $key=>$query)
            {
                $output .= $query . "\n";
            }
            $took = round(doubleval($times[$key]), 3);
            $output .= "===[took:{$took}]\n\n";
        }
		//da($output);
        $CI->load->helper('file'); 
        //  echo APPPATH  . "logs/queries.log.txt";
        if ( ! write_file(APPPATH  . "logs/queries.log.txt", $output, 'w+'))
        {
             da('queries.log.txt not available'); 
			 log_message('debug','Unable to write query the file');
        }  
        //da(APPPATH);

    }

}  

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */
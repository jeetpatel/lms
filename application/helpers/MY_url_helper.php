<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Assets URL
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('assets_url'))
{
    function assets_url($uri = '')
    {
        $CI =& get_instance();

        $assets_url = $CI->config->item('assets_url');

        return $assets_url . trim($uri, '/');
    }
}

/**
 * CSS URL
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('css_url'))
{
    function css_url($uri = '')
    {
        $CI =& get_instance();

        $css_url = $CI->config->item('css_url');

        return $css_url . trim($uri, '/');
    }
}

/**
 * JS URL
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('js_url'))
{
    function js_url($uri = '')
    {
        $CI =& get_instance();

        $js_url = $CI->config->item('js_url');

        return $js_url . trim($uri, '/');
    }
}

/**
 * Images URL
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('images_url'))
{
    function images_url($uri = '')
    {
        $CI =& get_instance();

        $images_url = $CI->config->item('images_url');

        return $images_url . trim($uri, '/');
    }
}

/**
 * Assets URL
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('bower_url'))
{
    function bower_url($uri = '')
    {
        $CI =& get_instance();

        $bower_url = $CI->config->item('bower_url');

        return $bower_url . trim($uri, '/');
    }
}

/* End of file MY_url_helper.php */
/* Location: ./application/helpers/MY_url_helper.php */
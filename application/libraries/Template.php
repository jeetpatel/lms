<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Template Library
 * Handle masterview and views within masterview
 */

class Template {

    private $_ci;

    protected $brand_name = SITENAME;
    protected $title_separator = ' - ';
    protected $ga_id = FALSE; // UA-XXXXX-X

    protected $layout = 'default';

    protected $title = FALSE;
    protected $description = FALSE;

    protected $metadata = array();
    
    protected $js = array();
    protected $css = array();
    
    protected $header = 'header';
    protected $footer = 'footer';

    protected $thirdparty_js = array();
    protected $thirdparty_css = array();

    protected $cdn_js = array();
    protected $cdn_css = array();

    function __construct()
    {
        $this->_ci =& get_instance();
    }

    /**
     * Set page layout view (1 column, 2 column...)
     *
     * @access  public
     * @param   string  $layout
     * @return  void
     */
    public function set_layout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * Set page header view (1 column, 2 column...)
     *
     * @access  public
     * @param   string  $header
     * @return  void
     */
    public function set_header($header)
    {
        $this->header = $header;
    }


    /**
     * Set page footer view (1 column, 2 column...)
     *
     * @access  public
     * @param   string  $footer
     * @return  void
     */
    public function set_footer($footer)
    {
        $this->footer = $footer;
    }

    /**
     * Set page title
     *
     * @access  public
     * @param   string  $title
     * @return  void
     */
    public function set_title($title)
    {
        $this->title = $title;
    }

    /**
     * Set page description
     *
     * @access  public
     * @param   string  $description
     * @return  void
     */
    public function set_description($description)
    {
        $this->description = $description;
    }

    /**
     * Add metadata
     *
     * @access  public
     * @param   string  $name
     * @param   string  $content
     * @return  void
     */
    public function add_metadata($name, $content)
    {
        $name = htmlspecialchars(strip_tags($name));
        $content = htmlspecialchars(strip_tags($content));

        $this->metadata[$name] = $content;
    }

    /**
     * Add js file path
     *
     * @access  public
     * @param   string  $js
     * @return  void
     */
    public function add_js($js)
    {
        $this->js[$js] = $js;
    }

    /**
     * Add css file path
     *
     * @access  public
     * @param   string  $css
     * @return  void
     */
    public function add_css($css)
    {
        $this->css[$css] = $css;
    }


    /**
     * Add thirdparty js file path
     *
     * @access  public
     * @param   string  $thirdpary_js
     * @return  void
     */
    public function add_thirdparty_js($thirdpary_js)
    {
        $this->thirdparty_js[$thirdpary_js] = $thirdpary_js;
    }



    /**
     * Add thirdparty css file path
     *
     * @access  public
     * @param   string  $thirdparty_css
     * @return  void
     */
    public function add_thirdparty_css($thirdparty_css)
    {
        $this->thirdparty_css[$thirdparty_css] = $thirdparty_css;
    }


    /**
     * Add CDN css file path
     *
     * @access  public
     * @param   string  $cdn_css
     * @return  void
     */
    public function add_cdn_css($cdn_css)
    {
        $this->cdn_css[$cdn_css] = $cdn_css;
    }



    /**
     * Add CDN js file path
     *
     * @access  public
     * @param   string  $cdn_js
     * @return  void
     */
    public function add_cdn_js($cdn_js)
    {
        $this->cdn_js[$cdn_js] = $cdn_js;
    }


    /**
     * Load view
     *
     * @access  public
     * @param   string  $view
     * @param   mixed   $data
     * @param   boolean $return
     * @return  void
     */
    public function load_view($view, $data = array(), $return = FALSE)
    {   
        // Not include master view on ajax request
        if ($this->_ci->input->is_ajax_request())
        {
            $this->_ci->load->view($view, $data);
            return;
        }

        // Title
        if (empty($this->title))
        {
            $title = $this->brand_name;
        }
        else
        {
            $title = $this->title . $this->title_separator . $this->brand_name;
        }

        // Description
        $description = $this->description;

        // Metadata
        $metadata = array();
        foreach ($this->metadata as $name => $content)
        {
            if (strpos($name, 'og:') === 0)
            {
                $metadata[] = '<meta property="' . $name . '" content="' . $content . '">';
            }
            else
            {
                $metadata[] = '<meta name="' . $name . '" content="' . $content . '">';
            }
        }
        $metadata = implode('', $metadata);

        // Javascript
        $js = array();
        foreach ($this->js as $js_file)
        {
            $js[] = '<script src="' . js_url($js_file) . '"></script>'; //'js/' . 
        }
        $js = implode('', $js);

        // CSS
        $css = array();
        foreach ($this->css as $css_file)
        {
            $css[] = '<link rel="stylesheet" href="' . css_url($css_file) . '">'; //'css/' . 
        }
        $css = implode('', $css);



        // Thirdparty js
        $thirdparty_js = array();
        foreach ($this->thirdparty_js as $thirdparty_js_file)
        {
            $thirdparty_js[] = '<script src="' . bower_url($thirdparty_js_file) . '"></script>';
        }
        $thirdparty_js = implode('', $thirdparty_js);

        // Thirdparty CSS
        $thirdparty_css = array();
        foreach ($this->thirdparty_css as $thirdparty_css_file)
        {
            $thirdparty_css[] = '<link rel="stylesheet" href="' . bower_url($thirdparty_css_file) . '">';
        }
        $thirdparty_css = implode('', $thirdparty_css);

        
        // CDN CSS
        $cdn_css = array();
        foreach ($this->cdn_css as $cdn_css_file)
        {
            $cdn_css[] = '<link rel="stylesheet" href="' . $cdn_css_file . '">';
        }
        $cdn_css = implode('', $cdn_css);

        // CDN JS
        $cdn_js = array();
        foreach ($this->cdn_js as $cdn_js_file)
        {
            $cdn_js[] = '<script src="'  . $cdn_js_file .'"></script>';
        }
        $cdn_js = implode('', $cdn_js);

        
        

        $header = $this->_ci->load->view($this->header, $data, TRUE);
        $footer = $this->_ci->load->view($this->footer, $data, TRUE);

        $main_content = $this->_ci->load->view($view, $data, TRUE);

        $body = $this->_ci->load->view('layout/' . $this->layout, array(
            'header' => $header,
            'footer' => $footer,
            'main_content' => $main_content,
        ), TRUE);

        return $this->_ci->load->view('base_view', array(
            'title' => $title,
            'description' => $description,
            'metadata' => $metadata,
            'js' => $js,
            'css' => $css,
            'thirdparty_css' => $thirdparty_css,
            'thirdparty_js' => $thirdparty_js,
            'cdn_css' => $cdn_css,
            'cdn_js' => $cdn_js,
            'body' => $body,
            'ga_id' => $this->ga_id,
        ), $return);
    }
}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */
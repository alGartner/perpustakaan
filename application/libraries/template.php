<?php
/**
 * Created by PhpStorm.
 * User: AiGartner
 * Date: 4/1/2020
 * Time: 3:32 AM
 */

class Template {

    protected $_ci;

    function __construct()
    {
        $this->_ci =&get_instance();
    }
    function display($template,$data=null)
    {
        if(!$this->is_ajax()){
            $data['_head']=$this->_ci->load->view('adminlte/head',$data, true);
            $data['_header']=$this->_ci->load->view('adminlte/header',$data, true);
            $data['_sidebar']=$this->_ci->load->view('adminlte/sidebar',$data, true);
            $data['_content']=$this->_ci->load->view($template, $data, true);
            $data['_footer']=$this->_ci->load->view('adminlte/footer',$data, true);
            $data['_js']=$this->_ci->load->view('adminlte/js',$data, true);
            $this->_ci->load->view('/adminlte.php',$data);
        }
        else
        {
            $this->_ci->load->view($template,$data);
        }
    }

    function is_ajax()
    {
        return ($this->_ci->input->server('HTTP_X_REQUESTED_WITH')&&($this->_ci->input->server('HTTP_X_REQUESTED_WITH')=='XMLHttpRequest'));
    }
}
<?php
class Template
{
    protected $_ci;

    function __construct()
    {
        $this->_ci = &get_instance();
    }

    function view($template, $data = null, $title = "Default Title")
    {
        $data['_content'] = $this->_ci->load->view($template, $data, true);
        $data['_title'] = $title;
        $this->_ci->load->view('template/admin/template', $data);
    }
}

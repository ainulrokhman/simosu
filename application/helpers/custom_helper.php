<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists('template_view')) {
    function template_view($var = null, $data)
    {
        $ci = &get_instance();
        $ci->load->view('template/header', $data);
        $ci->load->view('template/sidebar');
        if ($var) {
            $ci->load->view($var);
        }
        $ci->load->view('template/footer');
    }
}

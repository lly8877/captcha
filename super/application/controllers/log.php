<?php 

class Log extends CI_Controller {
  function __construct()
  {
      parent::__construct();
      $this->load->model('log_model');
      $this->load->helper('log_view_helper');
  }

  function readall()
  {
    $data['records'] = $this->log_model->get_all_log();
    $template['content'] = $this->load->view('readall', $data, true);
    $this->load->view('maintemplate', $template); 
  }

  function number_by_date()
  {
    $data['captcha_num'] = $this->log_model->get_captcha_num_by_date();
    $template['content'] = $this->load->view('number_by_date', $data, true);
    $this->load->view('maintemplate', $template); 
  }

  function top10site()
  {
    $data['data_strings'] = $this->log_model->get_top_10_site_array();
    $template['content'] = $this->load->view('top_10_site', $data, true);
    $this->load->view('maintemplate', $template); 
  }

  //Use this to populate the database!!
  function populate_log(){
    $affected_rows = $this->log_model->populate_database();
    if ($affected_rows == 0){
      echo "Failed";
    }
    else
      echo "Successed! {$affected_rows} row(s) affected.";
  }

}

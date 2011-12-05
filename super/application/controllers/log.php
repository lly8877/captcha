<?php 

class Log extends CI_Controller {
  function __construct()
  {
      parent::__construct();
      $this->load->model('log_model');
      $this->load->helper('log_view_helper');
      $this->load->helper('application_view_helper');
      $this->load->library('table');
  }

  function readall()
  {
    $data['records'] = $this->log_model->get_all_log();
    $template['content'] = $this->load->view('log_readall', $data, true);
    $this->load->view('maintemplate', $template); 
  }

  function number_by_date()
  {
    $data['captcha_num'] = $this->log_model->get_captcha_num_by_date();
    $template['content'] = $this->load->view('log_number_by_date', $data, true);
    $this->load->view('maintemplate', $template); 
  }

  function top_10_site($recent)
  {
    if ($recent!='year' and $recent!='month' and $recent!='day' and $recent!='hour')
      $recent = 'year';
    if ($recent == 'year')
      $data['recent_unit'] = '最近一年';
    else if ($recent == 'month')
      $data['recent_unit'] = '最近一月';
    else if ($recent == 'day')
      $data['recent_unit'] = '最近一天';
    else if ($recent == 'hour')
      $data['recent_unit'] = '最近一小时';
    $data['data'] = $this->log_model->get_top_10_site_array($recent);
    $template['content'] = $this->load->view('log_top_10_site', $data, true);
    $this->load->view('maintemplate', $template); 
  }

  function by_class($recent)
  {
    if ($recent!='year' and $recent!='month' and $recent!='day' and $recent!='hour')
      $recent = 'year';
    if ($recent == 'year')
      $data['recent_unit'] = '最近一年';
    else if ($recent == 'month')
      $data['recent_unit'] = '最近一月';
    else if ($recent == 'day')
      $data['recent_unit'] = '最近一天';
    else if ($recent == 'hour')
      $data['recent_unit'] = '最近一小时';
    $data['data'] = $this->log_model->by_class($recent);
    $template['content'] = $this->load->view('log_by_class', $data, true);
    $this->load->view('maintemplate', $template); 
  }

  function single_class_history($class_id)
  {
    if(isset($class_id))
    {
      $class_id = (int)$class_id;
    }
    $data['class_id'] = $class_id;
    $data['captcha_num'] = $this->log_model->get_captcha_num_by_date($class_id);
    $template['content'] = $this->load->view('log_number_by_date', $data, true);
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

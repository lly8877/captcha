<?php 

class Problem extends CI_Controller {
  function __construct()
  {
      parent::__construct();
      $this->load->model('problem_model');
      $this->load->helper('application_view_helper');
      $this->load->library('table');
  }

  function by_class_summary()
  {
    $data['total_num'] = $this->problem_model->get_total_problem_num();
    $data['data'] = $this->problem_model->get_less_than_lower_limit_class();
    $template['content'] = $this->load->view('problem_status', $data, true);
    $this->load->view('maintemplate', $template); 
  }

  function by_class()
  {
    $data['data'] = $this->problem_model->get_num_by_class();
    $template['content'] = $this->load->view('problem_by_class', $data, true);
    $this->load->view('maintemplate', $template); 
  }




  //Use this to populate the database!!
  function populate_problem(){
    $affected_rows = $this->problem_model->populate_database();
    if ($affected_rows == 0){
      echo "Failed";
    }
    else
      echo "Successed! {$affected_rows} row(s) affected.";
  }

}

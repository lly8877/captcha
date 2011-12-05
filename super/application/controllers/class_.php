<?php 

class Class_ extends CI_Controller {
  function __construct()
  {
      parent::__construct();
      $this->load->model('class_model');
      $this->load->helper('application_view_helper');
  }

  /*
  {
   $data['data_strings'] = $this->log_model->get_top_10_site_array($recent);
    $template['content'] = $this->load->view('top_10_site', $data, true);
    $this->load->view('maintemplate', $template); 
  }
  */

  //Use this to populate the database!!
  function populate(){
    $affected_rows = $this->class_model->populate_database();
    if ($affected_rows == 0){
      echo "Failed";
    }
    else
      echo "Successed! {$affected_rows} row(s) affected.";
  }

}

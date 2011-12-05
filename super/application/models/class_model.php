<?php

class Class_model extends CI_Model{
//******************************CODE FOR TEST ********************************
  //get ALL the class for _DEBUG_ _ONLY_.
  function get_all_class(){
    $q = $this->db->query('select * from class');

    if($q->num_rows()>0){
      foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
      return $data;
    }
  }

  //populate the database, for _TEST_ _ONLY_.
  function populate_database(){
    for($i = 2; $i < 200; $i++){
      $class = $this->generate_random_class($i);
      if ($this->db->insert('class',$class))
        continue;
      break;
    }
    return $i;
  }

  //a function help to populate the database, for _TEST_ _ONLY_.
  function generate_random_class($id){
    $new_class = array();
    $new_class['id'] = $id;
    $new_class['upper_limit'] = 10000;
    $new_class['lower_limit'] = 1000;
    $new_class['config_file'] = "fake_config_file";
    $new_class['handler_name'] = "fake_handler_name"; 
    $new_class['provider_id'] = ceil($id/4);
    return $new_class;
  }
}
//******************************TEST END********************************

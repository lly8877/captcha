<?php

class Problem_model extends CI_Model{
  function get_less_than_lower_limit_class()
  {
    $q = $this->db->query(
        "SELECT COUNT( problem.chaID ), problem.class_id, class.lower_limit
        FROM  `problem` 
        INNER JOIN class ON problem.class_id = class.id
        GROUP BY problem.class_id");
    return $q->result_array();
  }

  function get_less_than_lower_limit_class_w_head()
  {
    $q = $this->db->query(
      "
        SELECT COUNT( problem.chaID ), problem.class_id, class.lower_limit
        FROM  `problem` 
        INNER JOIN class ON problem.class_id = class.id
        GROUP BY problem.class_id");
    return $q;
  }





//******************************CODE FOR TEST ********************************
  //get ALL the problem for _DEBUG_ _ONLY_.
  function get_all_problem(){
    $q = $this->db->query('select * from problem');

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
    for($i = 1; $i < 10000; $i++){
      $problem = $this->generate_random_problem($i);
      if ($this->db->insert('problem',$problem))
        continue;
      break;
    }
    return $i;
  }

  //a function help to populate the database, for _TEST_ _ONLY_.
  function generate_random_problem($uniqe_num){
    $class_id = (string)rand(1,200);
    $image_id= (string)rand(1,20000);
    $answer = rand(1,10000);

    $question = "question{$answer}";
    $answer = "answer{$answer}";

    $new_problem = array();
    $new_problem['class_id'] = $class_id;
    $new_problem['image_id'] = $class_id;
    $new_problem['question'] = $question;
    $new_problem['answer'] = $answer;
    $new_problem['static_rand'] = $uniqe_num; 
    $new_problem['chaID'] = $uniqe_num;
    return $new_problem;
  }
}
//******************************TEST END********************************

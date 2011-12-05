<?php

class Log_model extends CI_Model{
  //get the number of captcha, group by day.
  function get_captcha_num_by_date($class_id="no_id"){
    $where = "";
    if ($class_id!="no_id"){
      $where = "WHERE class_id = $class_id";
    }
    $query_str = "
      SELECT DATE_FORMAT(issue_time,'%Y, %m-1, %d, %H') as time_start,
        COUNT(chaID) AS today_captcha_num,
        SUM(is_correct) AS correct_input,
        COUNT(finish_time) - SUM(is_correct) AS wrong_input,
        COUNT(chaID) - COUNT(finish_time) AS timeout_input
        FROM log
        $where
        GROUP BY time_start
      ";
    $q = $this->db->query($query_str);
    return $q->result_array();
  }

  function get_top_10_site_array($str='YEAR')
  { 
    $q = $this->db->query("
      SELECT 
      log.site_id as site_id,
      COUNT( log.chaID ) AS total_num, 
      SUM( log.is_correct ) AS correct_input, 
      (COUNT( log.finish_time ) - SUM( log.is_correct )) AS wrong_input, 
      (COUNT( log.chaID ) - COUNT( log.finish_time )) AS timeout_input
      FROM log
      WHERE issue_time >= DATE_SUB( NOW( ) , INTERVAL 1 {$str} ) 
      GROUP BY site_id
      ORDER BY total_num DESC 
      LIMIT 0 , 10
     ");
    return $q->result_array();
  }

  function by_class($str='YEAR'){
    $q = $this->db->query(
      "
      SELECT 
        class_id,
        COUNT(chaID) AS total_num,
        SUM(is_correct) AS correct_input,
        COUNT(finish_time) - SUM(is_correct) AS wrong_input,
        COUNT(chaID) - COUNT(finish_time) AS timeout_input
      FROM log
      WHERE issue_time >= DATE_SUB( NOW( ) , INTERVAL 1 {$str} ) 
      GROUP BY class_id
      ");
    return $q->result_array();
  }







//******************************CODE FOR TEST ********************************
  //get ALL the log for _DEBUG_ _ONLY_.
  function get_all_log(){
    $q = $this->db->query('select * from log');

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
    $log = $this->get_a_start_log();
    $log = $this->generate_next_random_log($log);
    for($i = 0; $i < 100000; $i++){
      $formatted_log = $this->log_model->format($log);
      if ($this->db->insert('log',$formatted_log))
        $log = $this->generate_next_random_log($log);
      else
        break;
    }
    return $i;
  }

  //a function help to populate the database, for _TEST_ _ONLY_.
  function generate_next_random_log($log){
    $answer_time_in_second = (string)rand(3,30);
    $issue_interval_in_second = (string)rand(0,10);
    $class_id = rand(1,3);
    $question = rand(1,10000);
    $correct_answer = rand(1,10000);
    $user_answer_is_correct = (rand(1,10)>7);
    if ($user_answer_is_correct){
      $user_answer = $correct_answer;
      $is_correct = 1;
    }
    else{
      $user_answer = rand(10001,20000);
      $is_correct = 0;
    }
    $visitor_ip = rand(1000000,2000000);
    $site_id = rand(1,2000);
    $site_ip = 8890800+$site_id;
    $referrer = "referrer: ?";
    $provider_id = rand(1,50);

    $question = "question{$question}";
    $correct_answer = "answer{$correct_answer}";
    $user_answer = "answer{$user_answer}";
    $answer_time = "PT{$answer_time_in_second}S";
    $issue_interval = "PT{$issue_interval_in_second}S";

    $newlog = array();
    $newlog['chaID'] = $log['chaID'] + 1;
    $newlog['issue_time'] = $log['issue_time']->add(new DateInterval($issue_interval));
    if (rand(0,10)>1)
      $newlog['finish_time'] = $newlog['issue_time']->add(new DateInterval($answer_time)); 
    $newlog['class_id'] = $class_id;
    $newlog['question'] = $question;
    $newlog['correct_answer'] = $correct_answer;
    $newlog['user_answer'] = $user_answer;
    $newlog['visitor_ip'] = $visitor_ip;
    $newlog['is_correct'] = $is_correct;
    $newlog['site_id'] = $site_id;
    $newlog['site_ip'] = $site_ip;
    $newlog['referrer'] = $referrer; 
    $newlog['provider_id'] = $provider_id;
    return $newlog;
  }

  //a function help to populate the database, for _TEST_ _ONLY_.
  function format($log){
    $log['chaID'] = (string)$log['chaID'];
    $log['issue_time'] = $log['issue_time']->format('Y-m-d H:i:s');
    if (isset($log['finish_time']))
      $log['finish_time'] = $log['finish_time']->format('Y-m-d H:i:s');
    return $log;
  }

  //a function help to populate the database, for _TEST_ _ONLY_.
  function get_a_start_log(){
    $data = array(
      'chaID'          => 1, 
      'issue_time'     => new DateTime('2011-10-14 23:09:34'),
      'finish_time'    => new DateTime('2011-10-14 23:09:35'),
      'class_id'       => 1,
      'question'       => 'question:1',
      'correct_answer' => 'answer:1',
      'user_answer'    => 'answer:1',
      'visitor_ip'     => 1231,
      'is_correct'     => 1,
      'site_id'        => 1232,
      'site_ip'        => 1233,
      'referrer'       => '1234',
      'provider_id'    => 12
    );
    return $data;
  }
}
//******************************TEST END********************************

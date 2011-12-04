<?php

function print_number_by_date_js_seriesOption($query_res)
{
  $strings = print_captcha_num($query_res);
  $str = '';
  for ($i = 0; $i < 4; $i++)
  {
    $str .= "seriesOptions[{$i}] = {
    name: names[{$i}],
    data: {$strings[$i]}
    };";
  }
  return $str;
}

function print_captcha_num($query_res)
{
  $str_all = '[';
  $str_correct = '[';
  $str_wrong = '[';
  $str_timeout = '[';
  foreach ($query_res as $row)
  {
    $time_start = "[Date.UTC({$row['time_start']}, 0, 0), ";
    $wrong_input = $row['not_timeout_input']-$row['correct_input'];
    $time_out = $row['today_captcha_num']-$row['not_timeout_input'];
    $str_all     .= $time_start."{$row['today_captcha_num']}],";
    $str_correct .= $time_start."{$row['correct_input']}],";
    $str_wrong   .= $time_start."{$wrong_input}],";
    $str_timeout .= $time_start."{$time_out}],";
  }
  $str_all .= ']';
  $str_correct .= ']';
  $str_wrong .= ']';
  $str_timeout .= ']';
  $res[] = $str_all;
  $res[] = $str_correct;
  $res[] = $str_wrong;
  $res[] = $str_timeout;
  return $res;
}


function append_top10_params($data_array)
{
  $str = '';
  $i = 0;
  foreach ($data_array as $row)
  {
    $pie = print_pie_data($i, $row);
    $str .= "categories[categories.length] = {$row['site_id']};";
    $str .= "data[data.length] = {$pie};";
    $i++;
  }
  return $str;
}


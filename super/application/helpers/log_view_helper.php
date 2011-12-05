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
    $str_all     .= $time_start."{$row['today_captcha_num']}],";
    $str_correct .= $time_start."{$row['correct_input']}],";
    $str_wrong   .= $time_start."{$row['wrong_input']}],";
    $str_timeout .= $time_start."{$row['timeout_input']}],";
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


function append_top10_params($data_array, $id_str)
{
  $str = '';
  $i = 0;
  foreach ($data_array as $row)
  {
    $total_num = $row['total_num'];
    $wrong_input = $row['wrong_input'];
    $time_out_input = $row['timeout_input'];
    $correct_input = $row['correct_input'];
    $str .= "categories[categories.length] = {$row[$id_str]};\n";
    $str .= "data[data.length] = { 
              y: {$total_num},
              color: colors[{$i}],
              drilldown: {
                 categories: ['正确','错误','超时'],
                 data: [{$correct_input},{$wrong_input},{$time_out_input}],
                 color: colors[{$i}]
              }
    };";
    $i++;
  }
  return $str;
}

function site_contact_table($data_array)
{
  //data_array should be a query result from [publisher_site] or other table containing contact info.
  //TODO implement it (currently not tested)
  $str = "
      <td>SITE ID<td>
      <td>域名</td>
      <td>联系人</td>
      <td>联系方式</td>
      </th>";
}

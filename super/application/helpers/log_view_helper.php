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
    $total_num = $row['total_num'];
    $correct_input = $row['correct_input'];
    $wrong_input = $row['not_timeout_input']-$row['correct_input'];
    $time_out_input = $row['total_num']-$row['not_timeout_input'];
    $correct_input = $row['correct_input'];
    $str .= "categories[categories.length] = {$row['site_id']};\n";
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
  <table>
    <th>
      <td>SITE ID<td>
      <td>域名</td>
      <td>联系人</td>
      <td>联系方式</td>
      </th>";
  foreach ($data_array as $row)
  $str .= "
  <tr>
    <td>
      {$row['id']}
    </td>
    <td>
      {$row['domain_name']}
    </td>
    <td>
      {$row['contact_name']}
    </td>
    <td>
      {$row['contact_info']}
    </td>
  </tr>";
  $str .= "</table>";
  return $str;
}

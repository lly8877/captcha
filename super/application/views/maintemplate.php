<!DOCTYPE html>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<html>
<head>
<title>Super User</title>
<script src="/js/jquery.min.js" type="text/javascript"></script>
<script src="/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="/js/highstock.js" type="text/javascript"></script>
<script src="/js/highstock.src.js" type="text/javascript"></script>
<script src="/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="/css/jquery-ui.css" type="text/css" media="all">
<link rel="stylesheet" href="/css/table_jui.css" type="text/css" media="all">
<link rel="stylesheet" href="/css/table.css" type="text/css" media="all">
<link rel="stylesheet" href="/css/all.css" type="text/css" media="all">
</head>
<body>
<div id="wrapper">
  <div id="menu">
  <h2>首页</h2>
    <ul>
      <li><a href="<?= base_url() ?>log/number_by_date">总出码量统计</a></li>
    </ul>
    <ul>
      <li><a href="<?= base_url() ?>log/top_10_site/year">出码量top10</a></li>
    </ul>
    <ul>
      <li><a>近期异常</a></li>
    </ul>
    <ul>
      <li><a href="<?= base_url() ?>problem/by_class_summary">总待用码量/异常</a></li>
    </ul>
    <ul>
      <li><a>master generator</a></li>
    </ul>
  <h2>验证码类总状态</h2>
    <ul>
      <li><a href="<?= base_url() ?>log/by_class/year">出码比例</a></li>
    </ul>
    <ul>
      <li><a href="<?= base_url() ?>problem/by_class">每类待用码数量</a></li>
    </ul>
    <ul>
      <li><a>添加/删除类</a></li>
    </ul>
  <h2>验证码类管理</h2>
    <ul>
      <li><a href="<?= base_url() ?>log/single_class_history/1">历史图表</a></li>
    </ul>
    <ul>
      <li><a>显示该类图片</a></li>
    </ul>
    <ul>
      <li><a>清空该类待用码</a></li>
    </ul>
    <ul>
      <li><a>禁用/删除类</a></li>
    </ul>
  <h2>Scheme总状态</h2>
    <ul>
      <li><a>添加删除scheme</a></li>
    </ul>
  <h2>Scheme管理首页</h2>
    <ul>
      <li><a>调整scheme比例</a></li>
    </ul>
  <h2>下游网站总状态</h2>
    <ul>
      <li><a>手动添加新站</a></li>
      <li><a>出码量最高的下游网站top10</a></li>
      <li><a>禁用/解除禁用一个下游</a></li>
    </ul>
  <h2>下游网站管理首页</h2>
    <ul>
      <li><a>禁用/解禁</a></li>
      <li><a>查看private/public key</a></li>
      <li><a>生成新private/public key</a></li>
      <li><a>查看、修改domain name</a></li>
      <li><a>历史出码量图表，内容同上</a></li>
      <li><a>访问量最高的IP</a></li>
      <li><a>访问量最高的server IP</a></li>
      <li><a>访问最多的URL</a></li>
      <li><a>调整scheme</a></li>
    </ul>
 </div>
  <div id="content"><?= $content ?></div>
  <div id="footer"></div>
</div>
</body>
</html> 

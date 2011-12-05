<!DOCTYPE html>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<html>
<head>
<title>Super User</title>
<script src="/js/jquery.min.js" type="text/javascript"></script>
<script src="/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="/js/highstock.js" type="text/javascript"></script>
<script src="/js/highstock.src.js" type="text/javascript"></script>
<script class="jsbin" src="http://datatables.net/download/build/jquery.dataTables.nightly.js"></script>
<link rel="stylesheet" href="/css/jquery-ui.css" type="text/css" media="all">
<link rel="stylesheet" href="/css/all.css" type="text/css" media="all">
</head>
<body>
<div id="wrapper">
  <div id="menu">
  <h2><a href="<?= base_url() ?>log/number_by_date">首页</a></h2>
    <ul>
      <li><a href="<?= base_url() ?>log/number_by_date">总出码量统计</a></li>
    </ul>
    <ul>
      <li><a href="<?= base_url() ?>log/top_10_site">下游出码量TOP10</a></li>
    </ul>
    <ul>
      <li><a href="<?= base_url() ?>problem/get_less_than_lower_limit_class">总待用码量</a></li>
    </ul>
  </div>
  <div id="content"><?= $content ?></div>
  <div id="footer">
</div>
</div>
</body>
</html> 

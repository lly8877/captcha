<script>
$(document).ready(function(){
	$('table').dataTable();
});
</script>
<div>
<h2>总待用码量: <?= $total_num ?></h2>
<h2>码量异常</h2>
<?php 
    $this->table->set_heading(array('Class ID', '剩余数量', '下限'));
    echo $this->table->generate($data);
?>
</div>


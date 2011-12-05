
<script>
$(document).ready(function(){
	$('table').dataTable();
});
</script>
<div id=table_div>
<h2>各类待用码量</h2>
<?php 
    $this->table->set_heading(array('Class ID', '剩余数量', '下限', '上限'));
    echo $this->table->generate($data);
?>
</div>


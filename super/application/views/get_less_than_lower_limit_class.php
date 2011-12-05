<script>
$(document).ready(function(){
	$('table').dataTable();
});
</script>
<div id=table_div>
<h2>剩余码量</h2>
<?php 
    $this->table->set_heading(array('剩余数量', 'Class ID', '下限'));
    echo $this->table->generate($data);
?>
</div>


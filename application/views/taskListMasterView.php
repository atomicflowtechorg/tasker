<h2><?php echo $title; ?></h2>
<?php
$this->load->view('tasks/template/taskNav', $listUrl);
$this->load->view('lists/template/taskList', $taskList);
?>
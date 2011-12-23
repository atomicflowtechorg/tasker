<?php
foreach($users as $teamMember)
{
	$this->load->view('teams/template/teamMemberItem', $teamMember);
}
?>
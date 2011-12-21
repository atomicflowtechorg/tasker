<?php
echo "<ol>";
echo "<li><a href='".site_url("lists/create/individual/")."' title ='".lang('list_create_title')."'>".lang('list_create_text')."</a></li>";
foreach($lists as $list)
{
	echo "<li><a href='".site_url("list/$list->pkListId")."' title ='$list->fldListName'>$list->fldListName</a></li>";
}
echo "</ol>";
?>
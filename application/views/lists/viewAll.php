<?php
echo "<ol>";
echo "<li><a href='".site_url("lists/create/individual/")."' title ='Create new list'>Create A List</a></li>";
foreach($lists as $list)
{
	echo "<li><a href='".site_url("list/$list->pkListId")."' title ='$list->fldListName'>$list->fldListName</a></li>";
}
echo "</ol>";
?>
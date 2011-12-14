<?php
echo "<ol>";
echo "<li><a href='/lists/create/individual/' rel='#overlay' title ='Create new list'>Create A List</a></li>";
foreach($lists as $list)
{
	echo "<li><a href='/lists/show/$user/$list->pkListId/' rel='#overlay' title ='$list->fldName'>$list->fldName</a></li>";
}
echo "</ol>";
?>
<?
echo "<ol>";
foreach($lists as $list)
{
	echo "<li><a href='/lists/show/$user/$list->pkListId/' rel='#overlay' title ='$list->fldName'>$list->fldName</a></li>";
}
echo "</ol>";
?>
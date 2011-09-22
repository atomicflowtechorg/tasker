<div class ='teamInfo' style='float:left;'>
	<a href='/teams/create' title='Create New Team'>Create New Team</a>
</div>

<?
echo "<div class='teamInfo' style='float:left;'>";
echo "<a href='/teams/allUsers' title='View All Taskers'>View All Users</a>";
echo "</div>";
foreach($teams as $row)
{
echo "<div class='teamInfo' style='float:left;'>";
echo "<a href='/team/show/$row->pkTeamName' title='$row->pkTeamName'>$row->pkTeamName</a>";

echo "</div>";		
}
?>
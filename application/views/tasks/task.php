<div class="taskItem">
<?
foreach($task as $row)
{
	if( isset($row->pkUsername))
	{
		echo "<h3>".$row->fldName."</h3>";
		echo "<a href='/individual/show/$row->pkUsername' title='$row->pkUsername'><img src='".$row->fldProfileImage."' title='".$row->pkUsername."' class='taskProfileImage'/></a>";
		echo "<p>Assigned to: ".$row->pkUsername."</p>";
		echo "<p>DueDate: ".$row->fldDateDue."</p>";
		echo "<p>Notes: ".$row->fldNotes."</p>";
	}
	else
	{
		echo "<h3>".$row->fldName."</h3>";
		echo "<img src='/images/noImage.jpg' title='profileImage' class='taskProfileImage'/>";
		echo "<p>Assigned to: No one</p>";
		echo "<p>DueDate: ".$row->fldDateDue."</p>";
		echo "<p>Notes: ".$row->fldNotes."</p>";
	}

}
?>
</br>
</div>
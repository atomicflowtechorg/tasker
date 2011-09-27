<?
echo validation_errors(); 
		
$attributes = array('class' => 'listsView');
echo form_open('lists/create/'.$location.'/', $attributes);
echo form_fieldset();

echo form_label('List Name:', 'name');
$listName = array(
		  'name'        => 'name',
		  'id'          => 'name',
		  'placeholder' => 'Enter List Name...',
		  'maxlength'   => '140',
		  'size'        => '50',
		);
echo form_input($listName);

echo form_label('Type:', 'type');

$options['Personal']='Personal';
$options['Team']='Team';

echo form_dropdown('type',$options,'');

echo form_label('Team:', 'owner');
foreach($teams as $team)
{
	$teamNames[$team->fkTeamName] = $team->fkTeamName;
}
echo form_dropdown('owner', $teamNames, '');

echo form_label('Access Level:', 'access');

$statusOption['0'] = 'Private';
$statusOption['1'] = 'Public';

echo form_dropdown('access', $statusOption, $statusOption[0]);

echo form_submit('create', 'Create list');
echo form_fieldset_close();
?>
<?php
echo validation_errors(); 
		
$attributes = array('class' => 'listsView');
echo form_open('lists/create', $attributes);
echo form_fieldset();

echo form_label(lang('list_create_name_label'), 'name');
$listName = array(
		  'name'        => 'name',
		  'id'          => 'name',
		  'placeholder' => lang('list_create_name_placeholder'),
		  'maxlength'   => '140',
		  'size'        => '50',
		);
echo form_input($listName);

echo form_label(lang('list_create_type_label'), 'type');

$options['Personal']='Personal';
$options['Team']='Team';

echo form_dropdown('type',$options,'');

echo form_label(lang('list_create_owner_label'), 'owner');
foreach($teams as $team)
{
	$teamNames[$team->fkTeamName] = $team->fkTeamName;
}
echo form_dropdown('owner', $teamNames, '');

echo form_label(lang('list_create_accessLevel_label'), 'access');

$statusOption['0'] = 'Private';
$statusOption['1'] = 'Public';

echo form_dropdown('access', $statusOption, $statusOption[0]);

echo form_submit('create', lang('list_create_button'));
echo form_fieldset_close();
?>
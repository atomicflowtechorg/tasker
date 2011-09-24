<?
echo validation_errors(); 
		
$attributes = array('class' => 'listsView');
echo form_open('lists/create/'.$location, $attributes);
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

$options[0]='Personal';
$options[1]='Team';

echo form_dropdown('username',$options,$options[0]);
echo form_label('Access Level:', 'access');

$statusOption[0] = 'Private';
$statusOption[1] = 'Public';

echo form_dropdown('status', $statusOption, $statusOption[0]);

echo form_submit('create', 'Create list');
echo form_fieldset_close();
?>
<div class="teamItem">
<?

echo validation_errors(); 

$attributes = array('class' => 'teamCreate');
echo form_open('teams/create', $attributes);

echo form_label('Team Name:', 'teamName');
$teamName = array(
	  'name'        => 'teamName',
	  'id'          => 'teamName',
	  'value'       => set_value('teamName'),
	  'maxlength'   => '140',
	  'size'        => '50',
	);
echo form_input($teamName);

echo form_submit('create', 'Create');

?>
</div>
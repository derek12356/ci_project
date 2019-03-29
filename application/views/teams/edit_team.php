
<h1>Team</h1>

<?php $attributes = array('id'=>'team_edit_form', 'class'=>'form_horizontal');?>
<?php echo validation_errors("<p class='bg-danger'>");?>

<?php echo form_open('teams/edit/'. $team->id, $attributes);?>
<div class='form-group'>
    <?php echo form_label('Team Name');
    $data = array(
        'class' => 'form-control',
        'name' => 'team_name',
        'placeholder' => 'Enter Team Name',
        'value' => $team->name
    );
    echo form_input($data);
    ?> 
</div>
<div class='form-group'>
    <?php echo form_label('Team Description');
    $data = array(
        'class' => 'form-control',
        'name' => 'team_body',
        'value' => $team->description

    );
    echo form_textarea($data);
    ?> 
</div>

<!--
<div class='form-group'>
    <label for='team_input'>Team Members</label>
    <input class='form-control' id='team_input' name='team_input' type='text' value=''/>
    <div id="team_member" style="height: 150px; overflow: auto;">
    <?php foreach ($users as $user) { ?>
    <div id="team_member<?php echo $user['id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $user['username']; ?>
      <input type="hidden" name="team_member[]" value="<?php echo $user['id']; ?>" />
    </div>
    <?php } ?>
  </div>
</div>
-->

<div class='form-group'>
    <?php 
    $data = array(
        'class' => 'btn btn-primary',
        'name' => 'submit',
        'value' => 'Update'
    );
    echo form_submit($data);
    ?> 
</div>
<?php echo form_close();?>

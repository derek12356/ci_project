
<h1>Team</h1>

<?php $attributes = array('id'=>'team_create_form', 'class'=>'form_horizontal');?>
<?php echo validation_errors("<p class='bg-danger'>");?>

<?php echo form_open('teams/create', $attributes);?>
<div class='form-group'>
    <?php echo form_label('Team Name');
    $data = array(
        'class' => 'form-control',
        'name' => 'team_name',
        'placeholder' => 'Enter Team Name'
    );
    echo form_input($data);
    ?> 
</div>
<div class='form-group'>
    <?php echo form_label('Team Description');
    $data = array(
        'class' => 'form-control',
        'name' => 'team_body',

    );
    echo form_textarea($data);
    ?> 
</div>

<div class='form-group'>
    <?php 
    $data = array(
        'class' => 'btn btn-primary',
        'name' => 'submit',
        'value' => 'Create'
    );
    echo form_submit($data);
    ?> 
</div>
<?php echo form_close();?>

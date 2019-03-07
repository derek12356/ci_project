
<h1>Project</h1>

<?php $attributes = array('id'=>'project_create_form', 'class'=>'form_horizontal');?>
<?php echo validation_errors("<p class='bg-danger'>");?>

<?php echo form_open('projects/create', $attributes);?>
<div class='form-group'>
    <?php echo form_label('Project Name');
    $data = array(
        'class' => 'form-control',
        'name' => 'project_name',
        'placeholder' => 'Enter Project Name'
    );
    echo form_input($data);
    ?> 
</div>
<div class='form-group'>
    <?php echo form_label('Project Description');
    $data = array(
        'class' => 'form-control',
        'name' => 'project_body',

    );
    echo form_textarea($data);
    ?> 
</div>

<div class='form-group'>
    <?php 
    $data = array(
        'class' => 'btn btn-primary',
        'name' => 'submit',
        'value' => 'submit'
    );
    echo form_submit($data);
    ?> 
</div>
<?php echo form_close();?>


<h1>task</h1>
<?php $attributes = array('id'=>'task_create_form', 'class'=>'form_horizontal');?>
<?php echo validation_errors("<p class='bg-danger'>");?>

<?php echo form_open('tasks/create/'.$this->uri->segment(3).'', $attributes);?>
<div class='form-group'>
    <?php echo form_label('task Name');
    $data = array(
        'class' => 'form-control',
        'name' => 'task_name',
        'placeholder' => 'Enter task Name'
    );
    echo form_input($data);
    ?> 
</div>
<div class='form-group'>
    <?php echo form_label('task Description');
    $data = array(
        'class' => 'form-control',
        'name' => 'task_body',

    );
    echo form_textarea($data);
    ?> 
</div>

<div class='form-group'>
    <?php echo form_label('Due Time');
    $data = array(
        'class' => 'form-control datepicker',
        'name' => 'due_time',
        'type' => 'text',
        'data-date-format' => 'YYYY-MM-DD HH:00'

    );
    echo form_input($data);
    ?> 
</div>
<div class='form-group'>
    <label for='team_input'>Team Members</label>
    <input class='form-control' id='team_input' name='team_input' type='text' value='' placeholder='Search a Name'/>
    <div id="team_member" style="background:#eee;height: 150px; overflow: auto;">
    <?php foreach ($users as $user) { ?>
    <div class='margin-sm' id="team_member<?php echo $user['id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $user['username']; ?>
      <input type="hidden" name="task_user[]" value="<?php echo $user['id']; ?>" />
    </div>
    <?php } ?>
  </div>
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

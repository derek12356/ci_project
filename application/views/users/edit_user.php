
<h1>Edit User</h1>

<?php $attributes = array('id'=>'edit_user_form', 'class'=>'form_horizontal');?>

<?php echo form_open('users/edit', $attributes);?>
<div class='form-group'>
    <?php echo form_label('Username');
    echo form_error('username');
    $data = array(
        'class' => 'form-control',
        'name' => 'username',
        'placeholder' => 'Enter UserName',
        'value' =>$user->username
    );
    echo form_input($data);
    ?> 
</div>
<div class='form-group'>
   
    <?php echo form_label('Email');
    echo form_error('email');
    $data = array(
        'class' => 'form-control',
        'name' => 'email',
        'placeholder' => 'Enter Email',
        'value' => $user->email
    );
    echo form_input($data);
    ?> 
</div>
<div class='form-group'>
    <?php echo form_label('Password');
    echo form_error('password');
    $data = array(
        'class' => 'form-control',
        'name' => 'password',
        'placeholder' => 'Enter Password'
    );
    echo form_password($data);
    ?> 
</div>
<div class='form-group'>
    <?php echo form_label('Confirm Password');
   echo  form_error('confirm_password');
    $data = array(
        'class' => 'form-control',
        'name' => 'confirm_password',
        'placeholder' => 'Comfirm Password'
    );
    echo form_password($data);
    ?> 
</div>
<div class='form-group'>
    <?php echo form_label('First Name');
    echo form_error('first_name');
    $data = array(
        'class' => 'form-control',
        'name' => 'first_name',
        'placeholder' => 'Enter FirstName',
        'value'       => $user->first_name
    );
    echo form_input($data);
    ?> 
</div>
<div class='form-group'>
    <?php echo form_label('Last Name');
    echo form_error('last_name');
    $data = array(
        'class' => 'form-control',
        'name' => 'last_name',
        'placeholder' => 'Enter LastName',
        'value'       => $user->last_name
    );
    echo form_input($data);
    ?> 
</div>
<div class="form-group">
    <?php echo form_label('Team Manager');
    $options = array(
        '1' => 'yes',
        '0' => 'no'
    );
    echo form_dropdown('team_manager',$options,$user->team_manager);
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

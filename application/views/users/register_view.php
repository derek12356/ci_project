
<h1>Register</h1>

<?php $attributes = array('id'=>'register_form', 'class'=>'form_horizontal');?>

<?php echo form_open('users/register', $attributes);?>
<div class='form-group'>
    <?php echo form_label('Username');
    echo form_error('username');
    $data = array(
        'class' => 'form-control',
        'name' => 'username',
        'placeholder' => 'Enter UserName',
        'value' => set_value('username')
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
        'value' => set_value('email')
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
        'placeholder' => 'Enter Password',
        'value' => set_value('password')
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
        'placeholder' => 'Comfirm Password',
        'value' => set_value('confirm_password')
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
        'value' => set_value('first_name')
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
        'value' => set_value('last_name')
    );
    echo form_input($data);
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

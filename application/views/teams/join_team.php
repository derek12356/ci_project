
<h1>Join Team</h1>

<?php $attributes = array('id'=>'join_team', 'class'=>'form_horizontal');?>
<?php echo validation_errors("<p class='bg-danger'>");?>

<?php echo form_open('teams/join_team', $attributes);?>

<div class='form-group'>
    <label for='join_team'>Teams</label>
    <input class='form-control' id='join_team' name='join_team' type='text' value='' placeholder='Search a Name'/>
    <div id="team_name" style="background:#eee;height: 150px; overflow: auto;">
    <?php foreach ($teams as $team) { ?>
    <div class='margin-sm' id="team_name<?php echo $team['id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $team['name']; ?>
      <input type="hidden" name="team_user[]" value="<?php echo $team['id']; ?>" />
    </div>
    <?php } ?>
  </div>
</div>
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
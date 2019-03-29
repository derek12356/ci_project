<h1>Tasks</h1>
<?php if(isset($no_task)){ ?>
    <p><?php echo $no_task;?></p>
<?php }else{ ?>
<table class='table table-bordered'>
   <thead>
    <tr>
        <th>Project Name</th>
        <th>Proejct Description</th>
        <th>Date</th>
        <th>Due Time</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach($tasks as $task): ?>
        <tr>
            <td>
                <div><?php echo $task['data']->task_name;?></div>
                <a href="<?php echo base_url();?>tasks/edit/<?php echo $task['data']->id; ?>">View</a>   
            </td>
            <td><?php echo $task['data']->task_body;?></td>
            <td><?php echo date('D, m-d, H:i',strtotime($task['data']->date_created));?></td>
            <td>
                <?php echo date('D, m-d, H:i',strtotime($task['data']->due_time));?>
            </td>
            <td>
                <input class="toggle-status" <?php echo $task['checked']; ?> value="<?php echo $task['data']->id ?>" type="checkbox" data-toggle="toggle" data-on="Done" data-off="Active" data-onstyle="success" data-offstyle="info" data-size="mini">
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php };?>
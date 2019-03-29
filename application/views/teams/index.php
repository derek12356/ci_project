<h1>Teams</h1>
<p class='bg-success'>
    <?php if($this->session->flashdata('team_created')): 
    echo $this->session->flashdata('team_created');
    endif;
    ?>
    <?php if($this->session->flashdata('team_updated')): 
    echo $this->session->flashdata('team_updated');
    endif;
    ?>
    <?php if($this->session->flashdata('team_deleted')): 
    echo $this->session->flashdata('team_deleted');
    endif;
    ?>
</p>
    <a class='btn btn-primary pull-right' href="<?php echo base_url();?>teams/create">create team</a>
<table class="table table-hover">

    <thead>
        <tr>
            <th>Team Name</th>
            <th>Team Description</th>
        </tr>
    </thead>
    <tbody>
       
        <?php foreach($teams as $team): ;?>
        <tr>
        <?php echo "<td><a href='".base_url(). "teams/edit/" . $team->id . "'>" . $team->name . "</a></td>"; ?>
        <?php echo "<td>" . $team->description . "</td>"; ?>
            <td><a class='btn btn-danger' href="<?php echo base_url();?>teams/delete/<?php echo $team->id;?>"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
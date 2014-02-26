<?php
 if(!empty($posts)){?>
  <h2>Welcome! <?=$posts['email']?></h2>
  

<?php   }?>

<div id="navbar">

<ul><li class='first'>
<?php 
echo  $this->Html->link(
 'Update Profile',
 array('action' =>'Update')
);?>
</li><br>
<?php 
 $id=$this->Session->read('Users.id');?>
  
  <li><?php
echo  $this->Html->link(
 'View Profile',
 array('action' =>'view',$id)
);?>
</li><br>
<li>
<?php
echo  $this->Html->link(
 'Create Ticket',
 array('controller'=>'tickets','action' =>'create')
);?>
</li><br>
<li>
<?php
echo  $this->Html->link(
 'View Ticket',
 array('action' =>'')
);?>
</li><BR>
<li class='last'>
<?php
echo  $this->Html->link(
 'Invite',
 array('controller'=>'users','action' =>'invite')
);?>
</li>
</ul>
</div>

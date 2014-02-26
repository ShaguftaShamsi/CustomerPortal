 
<div class="main content clearfix">
<div class='banner'>

<h2> Invite others... </h2>
</div>
<p></p>

<div class="card signin-card clearfix">
<?php
$errorsLogin = $this->Session->flash();
  //debug($errorsLogin);
	echo '<span class="error">';
	if(isset($errorsLogin)) echo $errorsLogin;
	echo '</span>';
	
echo $this->Form->create('Invite');
echo $this->Form->input('email',array('label'=>'','placeholder'=>'Enter Email Here'));
echo $this->Form->end('Invite');?>
</div>
</div>



<?php
 if(!empty($email) && !empty($status)){?>
<div > 
<table>
<th>Email</th>
<th>Status</th>
<tr><td> <?php echo $email ;?></td>
   <td><?php echo $status ;?></td>
  <?php if($status='Pending'){?>
      <tr><td><?echo  $this->Html->link(
        'Resend',
 array('action' =>'invite')
       );
      } ?> 
</td></tr>
  </tr>
</table>
</div>
<?php   }





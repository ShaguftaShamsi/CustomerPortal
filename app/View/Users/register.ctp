<div class='signuponepage main content clearfix'>
<div class ='clearfix'>
<div class ='sign-up'>
	 
	<div class='signup-box'>
		<?php  $errorsLogin = $this->Session->flash();
  //debug($errorsLogin);
	echo '<span class="error">';
	if(isset($errorsLogin)) echo $errorsLogin;
	echo '</span>';?>
		<div class='form-element-multi-field-name'>
			<strong>Name</strong>
		 <fieldset>
		 	<legend>
		 	</legend>
		 	
		 	<table class ='table'><tr><td>
		 	 <?php
		 	 echo $this->Form->create("User");
		 	 echo $this->Form->input('first_name',array('label'=>false,));?>
		 	 </td><td><?php
             echo $this->Form->input('last_name',array('label'=>false,
             	));
             
		 	 ?>
		 	</table></tr></td>
	  </fieldset>
		

		  <strong>Email</strong>
		  <?php
		  echo $this->Form->input('email',array('label'=>false,
             	));?>
             	<strong>Create a password</strong>
           <?php echo $this->Form->input('password',array('label'=>false,
             	));?>
           <strong>Confirm your password</strong>
           <?php echo $this->Form->input('confirm_password',array('type'=>'password','label'=>false,
             	));?>
              <strong>Prove your are human</strong>
              <table><tr><td>
              <?php 	
           echo $this->Html->image($this->Html->url(array('controller'=>'users', 'action'=>'captcha'), true),array('id'=>'img-captcha','vspace'=>2));
echo '<strong><a href="#" id="a-reload">Can\'t read? Reload</a></strong>';?></td></tr>
<tr><td>
<?php 
echo '<strong>Enter security code shown above:</strong>';?> </tr></td>
<tr><td>
<?php 
echo $this->Form->input('User.captcha',array('autocomplete'=>'off','label'=>false,'class'=>''));?>
</tr></td>
</table>
          <?php  echo $this->Form->end('Create');?>

           </div> 
	</div>
</div>
</div>
</div>
 <?php echo $this->Form->end('Next');?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
$('#a-reload').click(function() {
	var $captcha = $("#img-captcha");
    $captcha.attr('src', $captcha.attr('src')+'?'+Math.random());
	return false;
});
</script>
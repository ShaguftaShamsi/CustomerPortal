


<div class="main content clearfix">
<div class='banner'>
<h1>Customer Portal</h1>
<h2> Sign in to continue...</h2>
</div>
<p></p>


<div class="card signin-card clearfix">
<p></p>
<p> 
<img class="profile-img" src="http://<?php echo $_SERVER['SERVER_NAME'] .$this->webroot?>img/images1.jpeg">
 </p>
<?php 
 $errorsLogin = $this->Session->flash();
  //debug($errorsLogin);
	echo '<span class="error">';
	if(isset($errorsLogin)) echo $errorsLogin;
	echo '</span>';
echo $this->Form->create('User');
echo $this->Form->input('email',array('value'=>'Email','label'=>''));
echo $this->Form->input('password',array('value'=>'Password','label'=>''));
?>
<p></p>
<?php
echo $this->Form->checkbox('checked') .'Keep me login';?>

<div class="need-help-reverse">

<?php echo $this->Html->link('Forget Password?',array('action'=> 'forgetPassword'));?>

</div>
<?php echo $this->Form->end('Login');?>
</div>
<div class="one-google">
<p class="create-account">
<?php echo  $this->Html->link(
 'Create an Account',
 array('action' =>'register')
);?>
</p>
</div>
</div>


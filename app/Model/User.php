<?php


class User extends AppModel{
 public $recursive = -1;
 public $hasOne = 'Profile';
 public $validate = array(
  'email' => array(
         'emailRule-1' =>array('rule'=>array('email'),'message'=>'Enter valid Email address'),
       
         'emailRule-2' =>array('rule'=>array('_validEmailDNS'),'message' => 'Enter valid email address'),
   ),
   'password' => array(
         'passwordRule-1' => array('rule' => 'alphaNumeric','message' => 'Password should be in alphanumeric characters'),
	'passwordRule-2' => array('rule' => array('between', 6,255),'message' => 'Password should be in between 6 to 255 characters long')
   ),
  'captcha'=>array(
        'rule' => array('matchCaptcha'),
        'message'=>'Failed validating human check.'
      ),
    );

  function matchCaptcha($inputValue)  {
    return $inputValue['captcha']==$this->getCaptcha(); //return true or false after comparing submitted value with set value of captcha
  }

  function setCaptcha($value) {
    $this->captcha = $value; //setting captcha value
  }

  function getCaptcha() {
    return $this->captcha; //getting captcha value
  }


function _validEmailDNS($check){
$user_email =explode('@',$check['email']);
 if(isset($user_email[1]) && $user_email[1] != ''){
  if(checkdnsrr($user_email[1],'Any'))
  return true;
  else 
   return false;
  }else{
     return false;
        }
 }
 
 

}

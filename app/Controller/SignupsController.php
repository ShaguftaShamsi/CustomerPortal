<?php
/**
	* (Sample) Controller for Showing the use of Captcha*
	* @author     Dave
	* @link       http://deliciouscakephp/
	* @version Tested ok in Cakephp 2.x
	*/
class SignupsController extends AppController {

	var $name = 'Signups';
	var $uses = array('Signup');
	var $helpers = array('Html', 'Form');
	public $components = array('Captcha');//'Captcha'
	//public $components = array('MathCaptcha', array('timer' => 3));

	function captcha()	{
		$this->autoRender = false;
		 print_r('hell');
		$this->layout='ajax';
		if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
			$this->Captcha = $this->Components->load('Captcha', array(
				'width' => 500,
				'height' =>900,
				'theme' => 'default', //possible values : default, random ; No value means 'default'
			)); //load it
			}
		$this->Captcha->create();
	}

	function add()	{
		if(!empty($this->request->data))	{
			if(!isset($this->Captcha))	{ //if Component was not loaded throug $components array()
				$this->Captcha = $this->Components->load('Captcha'); //load it
			}
			$this->Signup->setCaptcha($this->Captcha->getVerCode()); //getting from component and passing to model to make proper validation check
			$this->Signup->set($this->request->data);
			if($this->Signup->validates())	{ //as usual data save call
				//$this->Signup->save($this->request->data);//save or something
				// validation passed, do something
				$this->Session->setFlash('Data Validation Success');
			}	else	{ //or
				$this->Session->setFlash('Data Validation Failure');
				//pr($this->Signup->validationErrors);
				//something do something else
			}
		}
	}


    public function addind() {
        $this->set('captcha', $this->MathCaptcha->generateEquation());

    if ($this->request->is('post')) {
      $this->User->create();
      if ($this->MathCaptcha->validate($this->request->data['User']['captcha'])) {
        $this->User->save($this->request->data);
      } else {
        $this->Session->setFlash('The result of the calculation was incorrect. Please, try again.');
      }
    } 
  }
}
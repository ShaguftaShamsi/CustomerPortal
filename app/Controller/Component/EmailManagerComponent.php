<?php
class EmailManagerComponent extends Component{
	
	public $components = array('Email');
	
	/*function sendEmail($ids,$subject,$contents,$ccids = array()){
		
		//Configure::load('secured2d_config');
		$adminID = Configure::read('adminID');
		$hostID = Configure::read('hostID');
		$hostPassword = Configure::read('hostPassword');
		$hostIP = Configure::read('hostIP');
		$hostPort = Configure::read('hostPort');
		
		$fromAddress =  $adminID;
		
		$this->Email->reset();
		$this->Email->to = $ids;
		if(!empty($ccids) && $ccids[0] != ''){
			//debug($ccids);
			$this->Email->cc = $ccids;
		}
		$this->Email->subject = $subject;
		$this->Email->from = $fromAddress;
		
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs = 'html'; // because we like to send pretty mail
		
		$this->Email->smtpOptions = array(
		'port'=>'25',
		'timeout'=>'30',
		'host' => $hostIP,
		'username'=> $hostID,
		'password'=> $hostPassword,
		'client' => $hostIP
		);
		//debug($this->Email);
		/* Set delivery method */
		//$this->Email->delivery = 'smtp';
		/* Do not pass any args to send() */
		//$this->Email->send($contents);
		/* Check for SMTP errors. */
		//debug($this->Email->smtpError);
	//}*/
    public function sendEmail($to,$ms,$subject){
            print_r($to);
	$this->Email->to = $to;
         $this->Email->subject = $subject;
		$this->Email->from = 'shagufta_shamsi@yahoo.com';
          $this->Email->smtpOptions = array(
		'port'=>'587',
		'host' => 'mail.finaltier.com',
		'username'=> 'shagufta.shamsi@finaltier.com',
		'password'=> 'WorkLoad100'
		);
		//debug($this->Email);
	$this->Email->sendAs = 'html'; 
       $this->Email->delivery = 'smtp';
		/* Do not pass any args to send() */
		if($this->Email->send($ms))
                 return true;

}
}

<?php
/**
 * this class handle login, password reset, and new passwort 
 *
 * @author Andreas Ressmann
 * 23.01.2014
 */
class AuthController extends Core_AbstractController
{
	/**
	 * initialize the controller
	 * setting the page title 
	 */  
    public function init()
    {
		parent::init();
		$this->view->pageTitle = 'Anmeldung';
    }

	/**
	 * Main Action of the Controller that action handles 
	 * error, login, or logout messages
	 */
    public function indexAction() {
    	
        if($this->_getParam('error') == 'true') {
    		$this->authRole(Core_Plugin_Acl::ROLE_GUEST);
    		$this->messenger('Fehler bei der Anmeldung', 'Bitte überprüfe Benutzername und Passwort', 'e');
    	} else {
    		if($this->_getParam('logout') == 'true') {
    			$this->messenger('Du wurdest abgemeldet', '', 'i');	
    		} else {
    			$this->messenger('Herzlich Willkommen!', 'Bitte einloggen um fortzufahren...', 'i');
    		}
    	}
    }

	/**
	 * this action handles the main login process 
	 * after checking if it is the first login for the user the user will be 
	 * redirected to the right view
	 */
    public function processAction() {
    	
    	$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
    	
    	$request = $this->getRequest();
		$success = false;

    	if(!$request->isPost()) {
    		return $this->_helper->redirector('index');
    	}
    	
    	$username = htmlspecialchars($this->_getParam('username'));
    	$password = htmlspecialchars($this->_getParam('password'));
    	
    	$auth = new Core_Model_Auth();
		$auth->loadByIdentity($username);
		
		if (isset ($auth)) {
	        if($auth->getIsFirstLogin ()) {
	            $this->_redirect('/auth/passwordreset/id/' . $auth->getId ());
	        }
	        
			$credentials = array(
		    	'username' => $this->_getParam('username'),
		    	'password'	=> $this->_getParam('password')
		    );
		    
		    $adapter = new Core_Plugin_AuthAdapter();
	    	$success = $adapter->authenticate($auth, $credentials);
		}
		
	    if(!$success) {
    		$this->_redirect('/auth/index/error/true');
    	} else {
    		$this->_redirect('/index');
    	}
    }

	/**
	 * action to reset the password
	 * this function persist the new password
	 */
    public function passwordresetAction () {
        
        $id = $this->_getParam('id');
        $password = $this->_getParam('password');
        
        if (isset($id) && isset ($password)) {
            
            $auth = new Core_Model_Auth();
            $auth->loadById ($id);
            
            $auth->setIsFirstLogin (0);
            $auth->setPassword ($password);
            
            $auth->update ();
            
            $this->_redirect('/auth/');
        }
    }

	/**
	 * this action handles the password lost functionallity
	 * a mail with a special usertoken will be send to the user 
	 * after clicking to the link in the mail the user can reset his password
	 */
    public function passwordAction() {
    	
    	$this->view->mode = 'password-lost';
    	
        $userIdentifier = $this->_getParam('username');
        
    	if(isset ($userIdentifier) && $userIdentifier != '') {
    		$auth = new Core_Model_Auth();
    		$auth->loadByIdentity($userIdentifier);
    		$this->mailer->authPasswordReset($auth);
    		$this->view->status = 'tokenSent';
    		$this->view->statusText = 'Es wurde eine E-Mail an <strong>' . $auth->getIdentity() . '</strong> gesendet. Folge dem Link in der E-Mail um ein neues Passwort festzulegen.';
    	}
        else {
            $this->view->statusText = 'Bitte E-Mail eingeben!';
        }
    	
    	if($this->_getParam('token')) {
    		$this->view->mode = 'password-reset';
    		
    		$auth = new Core_Model_Auth();
    		$auth->loadByToken($this->_getParam('token'));
    		
    		if($auth->getId() != null) {
    			$this->view->statusText = 'Für: <strong>' . $auth->getIdentity() . '</strong>';
    			$this->view->token = $this->_getParam('token');
    			
    			if($this->_getParam('password')) {
    				
    				if($this->_getParam('password') == $this->_getParam('password2')) {
    					
    					if(strlen($this->_getParam('password')) < 3) {
    						$this->view->statusText .= '<br/><br/>Das Passwort muss aus zumindest 3 Zeichen bestehen.';	
    					} else {
    						
    						$auth->setPassword($this->_getParam('password'));
    						$auth->save();
    						
    						$this->view->statusText .= '<br/><br/>Dein neues Passwort wurde festgelegt und ist ab sofort gültig.';
    						$this->view->status = 'success';
    					}
    					
    				} else {
    					$this->view->statusText .= '<br/><br/>Passwörter stimmen nicht überein.';
    				}
    			}
    			
    		} else {
    			$this->view->status = 'tokenInvalid';
    			$this->view->statusText = 'Der angegebene Token ist ungültig oder abgelaufen';
    		}
    	}
    }
    
	/**
	 * logout action logging out the user
	 */
    public function logoutAction() {
    	
    	session_unset();
        $this->_redirect('/auth/index/logout/true');
    }
}
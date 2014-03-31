<?php
/**
 * this class handle all ajax calls and includes also 
 * the main api calls like booking amount or getting the transaction file
 *
 * @author Andreas Ressmann
 * 31.03.2014
 */
class ApiController extends Core_AbstractController
{
	/*
	 * initialize the controller
	 * setting content type and encoding disable the zend page rendering 
	 */   
    public function init() {
        
        parent::init();
        
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $this->getResponse()->setHeader('Content-Type', 'application/json');
        $this->view->encoding = 'UTF-8';
    }
    
	/**
	 * getting an AccountManager by Id and transform it to a json string
	 *
	 * @return json string 
	 */
    public function getaccountmanagerAction () {
        $id = $this->_getParam('id');
        
        $accountManager = new Core_Model_AccountManager ();
        
        if (isset ($id)) {
            $values = $accountManager->loadById ($id);
            
            if (isset ($values)) {
                return $this->apiControllerHelper->formatOutput($values);
            }
        }
    }
        
	/**
	 * Function to delete a AccountManager by the given Id
	 *
	 * @return json success message or a error message
	 */
    public function deleteaccountmanagerAction () {
        
        $id = $this->_getParam('id');
        
        try {
            if (isset ($id)) {
                $accountmanager = new Core_Model_AccountManager ();
                $accountmanager->delete ($id);
            }
            return $this->apiControllerHelper->formatOutput(array(
                'success'               => true,
                'success_title'     => 'Kundenbetreuer wurde erfolgreich gelöscht',
                'success_description'   => ''
            ));
        }
        catch (Exception $e) {
            echo var_dump($e);
            
            return $this->apiControllerHelper->formatOutput(array(
                'error'             => true,
                'error_title'       => 'Fehler beim Löschen des Kundenbetreuer',
                'error_description' => ''
            ));
        }
    }
    
	/**
	 * function to save or update a ApplicationManager object 
	 * the validation array includes the pattern for the validator to validate the 
	 * fields
	 *
	 * @return json success message or a error message
	 */
    public function editaccountmanagerAction () {
        
        $validation = array ('E-Mail' => 'identity:X:mail', 'Vorname' => 'firstname:X:string', 'Nachname' => 'lastname:X:string', 'TelefonNr' => 'telnr:N:string', 'PersNr' => 'persnr:X:persnr', 'Adresse' => 'address:X:string');
        
        $data = json_decode($_POST['data']);
        
        $id = $data->id;
        $identity = $data->identity;
        $firstname = $data->firstname;
        $lastname = $data->lastname;
        $telnr = $data->telnr;
        $persnr = $data->persnr;
        $address = $data->address;
        
        try {
            
            $accountManager = new Core_Model_AccountManager ();
            
            if (isset ($id) && $id != '') {
                $accountManager->loadById ($id);
            }
            
            $validationResponse = Core_Validationhelper::validate ($validation, $data);
            
            if ($validationResponse != null) {
                return $this->apiControllerHelper->formatOutput(array(
                    'error'             => true,
                    'error_title'       => 'Eingabefehler',
                    'error_description' => $validationResponse
                ));
            }
            
            $accountManager->setPersNr ($persnr);
            $accountManager->setFirstName ($firstname);
            $accountManager->setLastName ($lastname);
            $accountManager->setIdentity ($identity);
            $accountManager->setTelNr ($telnr);
            $accountManager->setAddress ($address);
            
            if (isset ($id) && $id != '') {
                $accountManager->update ();
            }
            else {
                $accountManager->setPassword (md5($lastname));
                $accountManager->setCreated (date('Y-m-d H:i:s'));
                $accountManager->setRoleId (Core_Plugin_Acl::ROLE_ACCOUNT_MANAGER);
                $accountManager->setIsActive (1);
                $accountManager->setIsFirstLogin (1);
                
                $accountManager->save();
            }
            
            return $this->apiControllerHelper->formatOutput(array(
                'success'               => true,
                'success_title'     => 'Kundenbetreuer wurde erfolgreich gespeichert',
                'success_description'   => ''
            ));
        }
        catch (Exception $e) {
            echo var_dump($e);
            
            return $this->apiControllerHelper->formatOutput(array(
                'error'             => true,
                'error_title'       => 'Fehler beim Speichern des Kundenbetreuers',
                'error_description' => ''
            ));
        }
    }   
}
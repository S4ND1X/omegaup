<?php

/**
 * 
 * Please read full (and updated) documentation at: 
 * https://github.com/omegaup/omegaup/wiki/Arena 
 *
 *
 * 
 * POST /contests/:id:/problem/new
 * Si el usuario tiene permisos de juez o admin, crea un nuevo problema para el concurso :id
 *
 * */
require_once("ApiHandler.php");

class Logout extends ApiHandler {
    
    
    protected function RegisterValidatorsToRequest() {
        
        // Only auth_token is needed for logout, which is verified in the authorization process
        return true;               
    }

    protected function GenerateResponse() {
        
        /*
         * Ok, they sent a valid auth, just erase it from the database.
         * */
        try
        {
            AuthTokensDAO::delete( $this->_auth_token );	
        }
        catch( Exception $e )
        {
            throw new ApiException(ApiHttpErrors::invalidDatabaseOperation(), $e);
	}

	setcookie('auth_token', '', 1, '/');
       
        // Happy ending
        $this->addResponse("status", "ok");
    }
}

?>

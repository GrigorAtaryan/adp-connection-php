<?php

$adp_logging = 0;
$adp_logmode = 0;
$adp_logfile = "/tmp/adpapi.log";


$libroot = realpath("../../") . "/";
$webroot = realpath("../client") . "/";

include("../adpapiConnection.class.php");



class adpapiConnectionFactoryTest extends \PHPUnit_Framework_Testcase
{

	//----------------------------------------------
	// Test creation factory with valid grant type
	//----------------------------------------------

	public function testFactoryGood() {


		include("testconfig.php");


		$config = array();

		$configuration = array (
        	'grantType' 			=> 'client_credentials',
        	'clientID'				=> $ADP_CC_CLIENTID,
        	'clientSecret'			=> $ADP_CC_CLSECRET,
        	'sslCertPath'			=> $ADP_CERTFILE,
        	'sslKeyPath'			=> $ADP_KEYFILE,
        	'tokenServerURL'		=> $ADP_APIROOT
    	);



		// Use this way, since using the factory statically does not
		// provide code coverage.

		$adpFactory = new adpapiConnectionFactory();
		$adpconn = $adpFactory->create($configuration);

		$this->assertTrue(TRUE);

	}

	//----------------------------------------------
	// Test creation factory with valid grant type
	//----------------------------------------------


	public function testFactoryBad() {

		include("testconfig.php");


		$config = array();

		$configuration = array (
        	'grantType' 			=> 'BadGrantType',
        	'clientID'				=> $ADP_CC_CLIENTID,
        	'clientSecret'			=> $ADP_CC_CLSECRET,
        	'sslCertPath'			=> $ADP_CERTFILE,
        	'sslKeyPath'			=> $ADP_KEYFILE,
        	'tokenServerURL'		=> $ADP_APIROOT
    	);

		try {

			// Use this way, since using the factory statically does not
			// provide code coverage.

			$adpFactory = new adpapiConnectionFactory();
			$adpconn = $adpFactory->create($configuration);

		}
		catch (Exception $e) {

			$this->assertTrue(TRUE);
			return;

		}

		$this->assertFalse(TRUE);

	}

	//----------------------------------------------
	// Test connect client credentials valid items
	//----------------------------------------------

	public function testCredentialsConnectValidCreds() {


		include("testconfig.php");


		$config = array();

		$configuration = array (
        	'grantType' 			=> 'client_credentials',
        	'clientID'				=> $ADP_CC_CLIENTID,
        	'clientSecret'			=> $ADP_CC_CLSECRET,
        	'sslCertPath'			=> $ADP_CERTFILE,
        	'sslKeyPath'			=> $ADP_KEYFILE,
        	'tokenServerURL'		=> $ADP_APIROOT
    	);

		try {

			$adpConn = new adpapiClientConnection($configuration);

		}
		catch (Exception $e) {

			$this->assertFalse(TRUE);
			exit();

		}

		try {

			$result = $adpConn->connect();

		}
		catch (Exception $e) {

			$this->assertFalse(TRUE);
			exit();

		}

		$this->assertTrue(TRUE);

	}


	//----------------------------------------------
	// Test connect client credentials invalid items
	//----------------------------------------------

	public function testCredentialsConnectInvalidCreds() {


		include("testconfig.php");

		$config = array();

		$configuration = array (
        	'grantType' 			=> 'client_credentials',
        	'clientID'				=> "55",
        	'clientSecret'			=> $ADP_CC_CLSECRET,
        	'sslCertPath'			=> $ADP_CERTFILE,
        	'sslKeyPath'			=> $ADP_KEYFILE,
        	'tokenServerURL'		=> $ADP_APIROOT
    	);

		try {

			$adpConn = new adpapiClientConnection($configuration);

		}
		catch (Exception $e) {

			$this->assertFalse(TRUE);
			exit();

		}

		try {

			$result = $adpConn->connect();

		}
		catch (Exception $e) {

			$this->assertTrue(TRUE);
			return;

		}

		$this->assertFalse(TRUE);

	}

	//----------------------------------------------
	// Test connect client credentials disconnect
	//----------------------------------------------

	public function testCredentialsDisconnect() {

		include("testconfig.php");


		$config = array();

		$configuration = array (
        	'grantType' 			=> 'client_credentials',
        	'clientID'				=> $ADP_CC_CLIENTID,
        	'clientSecret'			=> $ADP_CC_CLSECRET,
        	'sslCertPath'			=> $ADP_CERTFILE,
        	'sslKeyPath'			=> $ADP_KEYFILE,
        	'tokenServerURL'		=> $ADP_APIROOT
    	);

		try {

			$adpConn = new adpapiClientConnection($configuration);

		}
		catch (Exception $e) {

			$this->assertFalse(TRUE);
			exit();

		}

		try {

			$result = $adpConn->connect();

		}
		catch (Exception $e) {

			$this->assertFalse(TRUE);
			exit();

		}

		// Doesnt currently do anything, but must call it to test
		$adpConn->disconnect();

		$this->assertTrue(TRUE);

	}

	//----------------------------------------------
	// Test connect client credentials valid items
	//----------------------------------------------

	public function testAuthorizationConnectValidCreds() {


		include("testconfig.php");

		$configuration = array (
	        'grantType' 			=> 'authorization_code',
	        'clientID'				=> $ADP_AC_CLIENTID,
	        'clientSecret'			=> $ADP_AC_CLSECRET,
	        'sslCertPath'			=> $ADP_CERTFILE,
	        'sslKeyPath'			=> $ADP_KEYFILE,
	        'tokenServerURL'		=> $ADP_APIROOT,
	        'scope'					=> 'openid',
	        'responseType'			=> 'code',
	        'redirectURL'			=> $ADP_REDIRECTURL
	    );

		try {

			$adpConn = new adpapiAuthorizedConnection($configuration);

		}
		catch (Exception $e) {

			$this->assertFalse(TRUE);
			exit();

		}

		try {

			$result = $adpConn->getAuthRequest();

		}
		catch (Exception $e) {

			$this->assertFalse(TRUE);
			exit();

		}

		$this->assertTrue(TRUE);

	}

	public function testAuthDisconnect() {

		include("testconfig.php");

		$configuration = array (
	        'grantType' 			=> 'authorization_code',
	        'clientID'				=> $ADP_AC_CLIENTID,
	        'clientSecret'			=> $ADP_AC_CLSECRET,
	        'sslCertPath'			=> $ADP_CERTFILE,
	        'sslKeyPath'			=> $ADP_KEYFILE,
	        'tokenServerURL'		=> $ADP_APIROOT,
	        'scope'					=> 'openid',
	        'responseType'			=> 'code',
	        'redirectURL'			=> $ADP_REDIRECTURL
	    );

		try {

			$adpConn = new adpapiAuthorizedConnection($configuration);

		}
		catch (Exception $e) {

			$this->assertFalse(TRUE);
			exit();

		}

		$adpConn->disconnect();

		$this->assertTrue(TRUE);

	}


	public function testAuthRefreshtoken() {

		include("testconfig.php");

		$configuration = array (
	        'grantType' 			=> 'authorization_code',
	        'clientID'				=> $ADP_AC_CLIENTID,
	        'clientSecret'			=> $ADP_AC_CLSECRET,
	        'sslCertPath'			=> $ADP_CERTFILE,
	        'sslKeyPath'			=> $ADP_KEYFILE,
	        'tokenServerURL'		=> $ADP_APIROOT,
	        'scope'					=> 'openid',
	        'responseType'			=> 'code',
	        'redirectURL'			=> $ADP_REDIRECTURL
	    );

		try {

			$adpConn = new adpapiAuthorizedConnection($configuration);

		}
		catch (Exception $e) {

			$this->assertFalse(TRUE);
			exit();

		}

		$adpConn->refreshToken();

		$this->assertTrue(TRUE);

	}

	public function testAuthgetRefreshToken() {

		include("testconfig.php");

		$configuration = array (
	        'grantType' 			=> 'authorization_code',
	        'clientID'				=> $ADP_AC_CLIENTID,
	        'clientSecret'			=> $ADP_AC_CLSECRET,
	        'sslCertPath'			=> $ADP_CERTFILE,
	        'sslKeyPath'			=> $ADP_KEYFILE,
	        'tokenServerURL'		=> $ADP_APIROOT,
	        'scope'					=> 'openid',
	        'responseType'			=> 'code',
	        'redirectURL'			=> $ADP_REDIRECTURL
	    );

		try {

			$adpConn = new adpapiAuthorizedConnection($configuration);

		}
		catch (Exception $e) {

			$this->assertFalse(TRUE);
			exit();

		}

		$ans = $adpConn->getRefreshToken();



		$this->assertTrue(TRUE);

	}


	public function testAuthgetState() {

		include("testconfig.php");

		$configuration = array (
	        'grantType' 			=> 'authorization_code',
	        'clientID'				=> $ADP_AC_CLIENTID,
	        'clientSecret'			=> $ADP_AC_CLSECRET,
	        'sslCertPath'			=> $ADP_CERTFILE,
	        'sslKeyPath'			=> $ADP_KEYFILE,
	        'tokenServerURL'		=> $ADP_APIROOT,
	        'scope'					=> 'openid',
	        'responseType'			=> 'code',
	        'redirectURL'			=> $ADP_REDIRECTURL
	    );

		try {

			$adpConn = new adpapiAuthorizedConnection($configuration);

		}
		catch (Exception $e) {

			$this->assertFalse(TRUE);
			exit();

		}

		$ans = $adpConn->getState();

		$this->assertTrue(TRUE);

	}


}











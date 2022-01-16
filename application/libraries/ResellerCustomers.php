<?php

require FCPATH . 'vendor/autoload.php';

/**
 * Class Gsuite
 *
 * Gsuite instrument used to create and get resellers.
 *
 */
class ResellerCustomers
{
/**
     *
     * global variables
     *
     */
    private $resellerService;
    private $verificationService;
    

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Step 1 : Call retrieveToken Create Site Token To Verify
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function createSiteToken($RESELLER_ADMIN_EMAIL, $RESELLER_CUSTOMER_DOMAIN_ID)
    {
        // Full List of scopes:
        $OAUTH2_SCOPES = [
          Google_Service_Reseller::APPS_ORDER,
          Google_Service_SiteVerification::SITEVERIFICATION,
          Google_Service_Directory::ADMIN_DIRECTORY_USER,
        ];

        ######### REPLACE WITH YOUR OWN VALUES ###############
        $JSON_PRIVATE_KEY_FILE = 'dnet-workspace-api-9ef764a3dba5.json';
        $RESELLER_ADMIN_USER = $RESELLER_ADMIN_EMAIL;
        $CUSTOMER_DOMAIN = $RESELLER_CUSTOMER_DOMAIN_ID;
        ######################################################

        $client = new Google_Client();
        $client->setAuthConfig($JSON_PRIVATE_KEY_FILE);
        $client->setSubject($RESELLER_ADMIN_USER);
        $client->setScopes($OAUTH2_SCOPES);

        $this->resellerService = new Google_Service_Reseller($client);
        $this->verificationService = new Google_Service_SiteVerification($client);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Step 2 : Call retrieveToken Create Site Token To Verify
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function retrieveToken($MECHANISM_TYPE, $VERIFICATION_METHOD, $RESELLER_CUSTOMER_DOMAIN_ID){
        // Retrieve the site verification token and place it according to:
        // https://developers.google.com/site-verification/v1/getting_started#tokens
        $body =
        new Google_Service_SiteVerification_SiteVerificationWebResourceGettokenRequest([
          'verificationMethod' => $VERIFICATION_METHOD,
          'site' => [
            'type' => $MECHANISM_TYPE,
            'identifier' => $RESELLER_CUSTOMER_DOMAIN_ID
          ]
        ]);
        $response = $this->verificationService->webResource->getToken($body);
        print_r($response);exit;
        echo "----------------------------------<br/>";
        echo "Reseller Verification Token<br/>";
        echo "----------------------------------<br/>";
        echo "<pre>";
        print_r ($response);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Step 3 : Create Customer If not Exist
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		public function getCustomerById($RESELLER_CUSTOMER_DOMAIN_ID){
			// Determine if customer domain Found
	        try {
	          $response = $this->resellerService->customers->get($RESELLER_CUSTOMER_DOMAIN_ID);
	          echo "";
	        } catch(Google_Service_Exception $e) {
	          if ($e->getErrors()[0]['reason'] == 'notFound'){
	            echo "--------------------------------<br/>";
	            print ("Sorry! Domain Not Found. \n");
	            echo "--------------------------------<br/>";
	          } else {
	            throw $e;
	          }
	        }
		}
}


<?php

require FCPATH . 'vendor/autoload.php';

/**
 * Class Gsuite
 *
 * Gsuite instrument used to create and get resellers.
 *
 */
class ResellerGSuite
{
    /**
     *
     * global variables
     *
     */
    private $resellerService;
    private $directoryService;
    private $verificationService;
    

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Step 1 : Call retrieveToken Create Site Token To Verify
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function createSiteToken($RESELLER_ADMIN_EMAIL, $RESELLER_CUSTOMER_DOMAIN, $RESELLER_CUSTOMER_SITE)
    {

        // Full List of scopes:
        $OAUTH2_SCOPES = [
          Google_Service_Reseller::APPS_ORDER,
          Google_Service_SiteVerification::SITEVERIFICATION,
          Google_Service_Directory::ADMIN_DIRECTORY_USER
        ];

        ######### REPLACE WITH YOUR OWN VALUES ###############
        $JSON_PRIVATE_KEY_FILE = 'dnet-workspace-api-9ef764a3dba5.json';
        $RESELLER_ADMIN_USER = $RESELLER_ADMIN_EMAIL;
        $CUSTOMER_DOMAIN = $RESELLER_CUSTOMER_DOMAIN;
        $CUSTOMER_SITE = $RESELLER_CUSTOMER_SITE;
        ######################################################

        $client = new Google_Client();
        $client->setAuthConfig($JSON_PRIVATE_KEY_FILE);
        $client->setSubject($RESELLER_ADMIN_USER);
        $client->setScopes($OAUTH2_SCOPES);

        $this->resellerService = new Google_Service_Reseller($client);
        $this->directoryService = new Google_Service_Directory($client);
        $this->verificationService = new Google_Service_SiteVerification($client);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Step 2 : Call retrieveToken Create Site Token To Verify
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function retrieveToken($MECHANISM_TYPE, $VERIFICATION_METHOD, $RESELLER_CUSTOMER_DOMAIN){
        // Retrieve the site verification token and place it according to:
        // https://developers.google.com/site-verification/v1/getting_started#tokens
        $body =
        new Google_Service_SiteVerification_SiteVerificationWebResourceGettokenRequest([
          'verificationMethod' => $VERIFICATION_METHOD,
          'site' => [
            'type' => $MECHANISM_TYPE,
            'identifier' => $RESELLER_CUSTOMER_DOMAIN
          ]
        ]);
        $response = $this->verificationService->webResource->getToken($body);
//        echo "----------------------------------<br/>";
//        echo "Reseller Verification Token<br/>";
//        echo "----------------------------------<br/>";
//        echo "<pre>";
//        print_r ($response);
        return $response;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Step 3 : Create Customer If not Exist
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function verifyCustomer($RESELLER_CUSTOMER_DOMAIN){
        // Determine if customer domain already has Google Workspace
        try {
          $response = $this->resellerService->customers->get($RESELLER_CUSTOMER_DOMAIN);
//          echo "------------------------<br/>";
//          exit('Customer already exists<br/>------------------------<br/>');
//          echo "";
          return true;
        } catch(Google_Service_Exception $e) {
          if ($e->getErrors()[0]['reason'] == 'notFound'){
//            echo "--------------------------------<br/>";
//            print ("Domain available for creation\n");
//            echo "--------------------------------<br/>";
              return false;
          } else {
            // throw $e;
          }
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Step 3 : Create Customer
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function createCustomer($CUSTOMER_DATA, $RESELLER_CUSTOMER_DOMAIN){
        // Create customer resource
        $customer = new Google_Service_Reseller_Customer([
          'customerDomain' => $RESELLER_CUSTOMER_DOMAIN,
          'alternateEmail' => $CUSTOMER_DATA['alternateEmail'],
          'postalAddress' => [
            'contactName' => $CUSTOMER_DATA['contactName'],
            'organizationName' => $CUSTOMER_DATA['organizationName'],
            'countryCode' => $CUSTOMER_DATA['countryCode'],
            'postalCode' => $CUSTOMER_DATA['postalCode']
          ]
        ]);
        $response = $this->resellerService->customers->insert($customer);
        return $response;
//        echo "----------------------<br/>";
//        echo "Customer Record<br/>";
//        echo "----------------------<br/>";
//        echo "<pre>";
//        print_r ($response);
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Step 4 : Crate Admin User
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function createAdminUser($ADMIN_DATA, $RESELLER_CUSTOMER_DOMAIN){
    // Create first admin user
        $user = new Google_Service_Directory_User([
          'primaryEmail' => $ADMIN_DATA['primaryEmail'] . $RESELLER_CUSTOMER_DOMAIN,
          'password' => $ADMIN_DATA['password'],
          'name' => [
            'givenName' => $ADMIN_DATA['givenName'],
            'familyName' => $ADMIN_DATA['familyName'],
            'fullName' => $ADMIN_DATA['fullName']
          ]
        ]);
        $response = $this->directoryService->users->insert($user);
//        echo "----------------------<br/>";
//        echo "Admin User Record<br/>";
//        echo "----------------------<br/>";
//        echo "<pre>";
//        print_r ($response);
        return $response;
    }



    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Step 4 : Promote User To Admin
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function promoteUserToAdmin($MAKE_ADMIN, $RESELLER_CUSTOMER_DOMAIN){
        // Promote user to admin status
        $makeAdmin = new Google_Service_Directory_UserMakeAdmin([
          'status' => true
        ]);
        $this->directoryService->users->makeAdmin(
          $MAKE_ADMIN . $RESELLER_CUSTOMER_DOMAIN,
          $makeAdmin
        );
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Step 5 : Create Subscription
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function createSubscription($SUBSCRIPTION_PLAN, $RESELLER_CUSTOMER_DOMAIN){
        // Create subscription resource
        // For more details of params visit 
        // https://developers.google.com/admin-sdk/reseller/reference/rest/v1/subscriptions#Subscription

        $subscription = new Google_Service_Reseller_Subscription([
          'kind' => 'reseller#subscription',
          'customerId' => $RESELLER_CUSTOMER_DOMAIN,
          'skuId' => $SUBSCRIPTION_PLAN['skuId'],
          'plan' => [
            'planName' => $SUBSCRIPTION_PLAN['planName']
          ],
          'seats' => [
            "kind" => "subscriptions#seats",
            'maximumNumberOfSeats' => $SUBSCRIPTION_PLAN['maximumNumberOfSeats']
          ],
          'purchaseOrderId' => 'my_example_flex_1'
        ]);
        $response = $this->resellerService->subscriptions->insert(
          $RESELLER_CUSTOMER_DOMAIN,
          $subscription
        );
//        echo "----------------------<br/>";
//        echo "Subscription On Plan<br/>";
//        echo "----------------------<br/>";
//        echo "<pre>";
//        print_r ($response);
        return $response;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Step 6 : Verify Domain
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function verifyDomain($DESIGNATE_OWNER, $RESELLER_CUSTOMER_DOMAIN){
        // Verify domain and designate domain owners
        $body =
        new Google_Service_SiteVerification_SiteVerificationWebResourceResource([
          'site' => [
            'type' => 'INET_DOMAIN',
            'identifier' => $RESELLER_CUSTOMER_DOMAIN,
          ],
          'owners' => [$DESIGNATE_OWNER . $RESELLER_CUSTOMER_DOMAIN]
        ]);

        $response = $this->verificationService->webResource->insert('DNS_TXT', $body);
//        echo "----------------------<br/>";
//        echo "Verification Of Designation To Owner<br/>";
//        echo "----------------------<br/>";
//        echo "<pre>";
//        print_r ($response);
        return $response;
    }
    
    
    
    public function subscriptionChange($customerId,$subscriptionId,$seats){
        $seat = new Google_Service_Reseller_Seats([
          'numberOfSeats' => (int)$seats,
          'kind' => 'subscriptions#seats',
          'maximumNumberOfSeats' => (int)$seats
//          'licensedNumberOfSeats' => 3
        ]);
        $response = $this->resellerService->subscriptions->changeSeats($customerId,$subscriptionId,$seat);
       return $response;
    }
}



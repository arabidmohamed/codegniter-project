<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	* Controller to send emails to queued volunteers/members
	* How this controller works!
		- In this controller we have 3 functions
			1) sendEmail() 			  	-> Sends emails to the volunteers
			2) SendEmailToVolunteers() 	-> Email template
			3) __Email() 				-> Email configuration
		
		1) sendEmail() - how it works
			- This function will first get the volunteers from `volunteer_basic_info` table	with `Cron_Email_Flag` where equal to 1
			- After that get the Email to be sent to volunteers from `admin_volunteer_emails` table	with `In_Proccess_For_Members` where 			  equal to 1
			- Then it will check for (volunteers, email) number of rows if one of them return false, the emails won't send, Which probably 			  means that either the volunteers to whom the emaill will be sent are finished in table or no email to send, then update the 			  email status to 0 as its no longer be usable
			- Also it will check for if email has attachment file
			
			- Now if we have volunteers then we have to send email to them but before that we have to check daily email sending limit in 			 `tbl_cron_email_log` table if Limit_Exceeded returns 0 means Ok TO send emails else limit reached.
		
*/

class Send extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        if(!$this->input->is_cli_request()){
            echo "Permission Denied";
            die();
        }
        $this->load->model('Cronjob_model', 'cronjob');
    }

    public function sendEmail(){
        $limit = 150;
        $count = 0;
        $today_date = date("Y-m-d");
        $volunteers = $this->cronjob->getCronedVolunteers($limit);
        $subscribers = $this->cronjob->getCronedSubscribers($limit);
        $email = $this->cronjob->getInProcessEmail();

        $totalPendingEmailUsers = count($volunteers) + count($subscribers);

        if($totalPendingEmailUsers == 0 || !count($email)){
            // update email status for next email to be sent
            $this->cronjob->updateEmailProcessStatus();
            echo 'No Emails in the queue';
            die();
        }

        // check if email has attachment default is false
        $attach = false;
        if(strlen($email[0]->Attachment) > 0 && $email[0]->Attachment != 'NULL'){
            $attach = $email[0]->Attachment;
        }

        $emailToBeSentFlag = '';

        // first check if there are pending emails to be sent
        if(count($totalPendingEmailUsers)){
            // check for daily email limit
            $cronEmailLimit = $this->cronjob->getTodayCronEmailLimit($today_date);

            // if there is no record found for cronEmailLimit it means new request to send email.
            if(count($cronEmailLimit) == 0){ // means no record for today, it's a new request
                // insert cron limit for today
                $data_limit = array(
                    "Limit_Exceeded" => 0,
                    "Date" => $today_date
                );
                $emailToBeSentFlag = $this->cronjob->createCronEmailLimitFlag($data_limit);
            } else {
                $emailToBeSentFlag = $cronEmailLimit[0]->Limit_Exceeded;
            }
        }

        if(!$emailToBeSentFlag)
        {
            // send emails to members
            foreach($volunteers as $volunteer){

                if(!$this->SendEmailToVolunteers($volunteer->Email, $volunteer->Name, $email[0]->Email_Subject, $email[0]->Email_Message, $attach)){
                    echo 'Email not sent';
                } else {
                    // email sent to update this member status
                    $this->cronjob->updateVolunteerCronStatus($volunteer->Customer_ID);
                }
                $count++;
            } // end foreach

            if(count($subscribers) > 0)
            {
                // send emails to members
                foreach($subscribers as $s)
                {

                    if(!$this->SendEmailToVolunteers($s->Email, '', $email[0]->Email_Subject, $email[0]->Email_Message, $attach)){
                        echo 'Email not sent';
                    } else {
                        // email sent to update this member status
                        $this->cronjob->updateSubscribersCronStatus($s->ID);
                    }
                    $count++;
                } // end foreach
            }

            if($count >= $limit){
                // update once the daily limit in
                $this->cronjob->updateCronEmailLimitStatus($today_date);
            }

            echo 'Email sent successfully';
        } else {
            echo 'Email limit reached!';
        }
    }

    public function SendEmailToVolunteers($volunteerEmail, $volunteerName, $subject, $message, $attach)
    {
        $data = array(
            "volunteerEmail" => $volunteerEmail,
            "volunteerName" => $volunteerName,
            "subject" => $subject,
            "message" => $message
        );
        $this->load->library('parser');
        $tempMesg = ''.$this->parser->parse('includes/email/temp-all-subs', $data, TRUE);

        $sbj = $subject;
        if(!$this->__Email($volunteerEmail, $subject, $tempMesg, $attach, $sbj)){
            return false;
        }

        return true;
    }

    public function __Email($to, $param2, $message, $attach = false, $subject)
    {
        //send email
        $options = array(
            'to' => $to,
            'subject' => $subject,
            'message' => $message
        );

        if($attach)
        {
            $options['attach'] = $attach;
        }

        $this->load->helper('utilities_helper');
        return SendEmail($options);
    }
}
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Utils;

/**
 * Description of EmailSenderUtility
 *
 * @author anand
 */
class EmailSenderUtility {

    protected static $_emailProfile = 'gcDubaiProfile';
    protected static $_emailFrom = 'info@gc-dubai.com';
    protected static $_emailFromName = '3Rosaty Support Team';
    protected static $_emailFormat = 'html';
    protected static $_toEmailAddresses = [
        'anand@vibeosys.com',
            //'kaladdin@gmail.com',
            //'Kaladdin@gc-dubai.com'
    ];

    //put your code here
    public static function sendForgotPasswordEmail($emailId, $name, $password) {
        $email = new \Cake\Mailer\Email(static::$_emailProfile);
        $email->emailFormat(static::$_emailFormat)->template('ForgotPasswordEmail')
                ->viewVars(['email' => $emailId, 'name' => $name, 'password' => $password])
                ->from(static::$_emailFrom, static::$_emailFromName)
                ->to($emailId, $name)
                ->subject('3Rosaty forgot password');
        $emailSendSuccess = $email->send();
        return $emailSendSuccess;
    }

    public static function sendPortfolioRequestOnEmail($portfolioInfo, $userInfo, $message) {
        $email = new \Cake\Mailer\Email(static::$_emailProfile);
        $email->emailFormat(static::$_emailFormat)->template('ServiceRequestEmail')
                ->viewVars(['portfolio' => $portfolioInfo, 'customer' => $userInfo, 'message' => $message])
                ->from(static::$_emailFrom, static::$_emailFromName)
                ->addTo(static::$_toEmailAddresses)
                ->subject('3Rosaty service request');
        $emailSendSuccess = $email->send();
        return $emailSendSuccess;
    }

    public static function sendContactUsEmail($contactUsRequest) {
        $email = new \Cake\Mailer\Email(static::$_emailProfile);
        $email->emailFormat(static::$_emailFormat)->template('ContactUsRequestEmail')
                ->viewVars(['Name' => $contactUsRequest->name,
                    'Phone' => $contactUsRequest->phone,
                    'EmailId' => $contactUsRequest->emailId,
                    'Message' => $contactUsRequest->message])
                ->from(static::$_emailFrom, static::$_emailFromName)
                ->addTo(static::$_toEmailAddresses)
                ->subject('3Rosaty contact us request');

        $emailSendSuccess = $email->send();
        return $emailSendSuccess;
    }

    /**
     * Sends pay later email to subscriber
     * @param \App\Dto\SubscriberPayLaterDto $subscriberDetails
     * @return boolean
     */
    public static function sendPayLaterEmail($subscriberDetails) {
        $email = new \Cake\Mailer\Email(static::$_emailProfile);
        $email->emailFormat(static::$_emailFormat)->template('PayLaterEmail')
                ->viewVars(['name' => $subscriberDetails->name,
                    'phone' => $subscriberDetails->mobileNo,
                    'emailId' => $subscriberDetails->emailId,
                    'country' => $subscriberDetails->country,
                    'sType' => $subscriberDetails->sType])
                ->from(static::$_emailFrom, static::$_emailFromName)
                ->addTo(static::$_toEmailAddresses)
                ->subject('3Rosaty pay later subscriber');

        $emailSendSuccess = $email->send();
        return $emailSendSuccess;
    }

    /**
     * 
     * @param \App\Dto\SubscriberPayLaterDto $subscriberDetails
     * @return type
     */
    public static function sendWelcomeEmail($subscriberDetails) {
        $email = new \Cake\Mailer\Email(static::$_emailProfile);
        $email->emailFormat(static::$_emailFormat)->template('SubscriberWelcomeEmail')
                ->viewVars(['name' => $subscriberDetails->name])
                ->from(static::$_emailFrom, static::$_emailFromName)
                ->addTo($subscriberDetails->emailId, $subscriberDetails->name)
                ->addBcc('anand@vibeosys.com')
                ->subject('Welcome to 3Rosaty');

        $emailSendSuccess = $email->send();
        return $emailSendSuccess;
    }
	
    /**
     * Sends notification to admin about new customer registration
     * @param \App\Dto\UserRegistrationNotificationDto $userRegistrationNotification
     * @return object
     */
    public static function sendCustomerRegistrationNotificationEmail($userRegistrationNotification){
        $email = new \Cake\Mailer\Email(static::$_emailProfile);
        $email->emailFormat(static::$_emailFormat)->template('UserRegistrationNotificationEmail')
                ->viewVars(['name' => $userRegistrationNotification->name,
                    'phone' => $userRegistrationNotification->phone,
                    'emailId' => $userRegistrationNotification->emailId,
                    'registrationChannel' => $userRegistrationNotification->registrationChannel])
                ->from(static::$_emailFrom, static::$_emailFromName)
                ->addTo(static::$_toEmailAddresses)
                ->subject('Fananz new customer registration');

        $emailSendSuccess = $email->send();
        return $emailSendSuccess;
    }
}

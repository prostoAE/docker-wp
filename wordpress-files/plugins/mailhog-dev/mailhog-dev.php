<?php

/**
 * Plugin Name:  Mailhog Dev
 * Description:  Mailhog plugin for email testing
 */

class WP_MAILHOG {

    function __construct() {
        $this->AddSMTP();
    }

    /*
     * Wordpress default hook to config php mail
     */
    private function AddSMTP() {
        add_action('phpmailer_init', array(
            $this,
            'configEmailSMTP'
        ));
    }

    /*
     * Config MailTramp SMTP
     */
    public function configEmailSMTP($phpmailer) {
        $phpmailer->Host = 'mailhog';
        $phpmailer->Port = 1025;
        $phpmailer->IsSMTP();
    }
}

new WP_MAILHOG();

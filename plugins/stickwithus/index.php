<?php
/*
Plugin Name: stickwithus
Plugin URI: https://getin.agency
Description: stickwithus
Version: 1.0
Author: GET IN
Author URI: https://getin.agency
*/

function create_entry_tables() {

  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();

  $tablename = $wpdb->prefix."entry";

  $sql = "CREATE TABLE $tablename (
  id mediumint(11) NOT NULL AUTO_INCREMENT,
  firstname tinytext,
  lastname tinytext,
  email tinytext,
  phone tinytext,
  contact_type tinytext,
  selected_formula tinytext,
  company_name tinytext,
  company_activity tinytext,

  PRIMARY KEY  (id)
  ) $charset_collate;";

  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );
}

register_activation_hook( __FILE__, 'create_entry_tables' );

function akismet_comment_check( $api_key, $data ) {
    $request = 'api_key=' . urlencode( $api_key ) .
        '&blog=' . urlencode( $data['blog'] ) .
        '&user_ip=' . urlencode( $data['user_ip'] ) .
        '&user_agent=' . urlencode( $data['user_agent'] ) .
        '&referrer=' . urlencode( $data['referrer'] ) .
        '&permalink=' . urlencode( $data['permalink'] ) .
        '&comment_type=' . urlencode( $data['comment_type'] ) .
        '&comment_author=' . urlencode( $data['comment_author'] ) .
        '&comment_author_email=' . urlencode( $data['comment_author_email'] ) .
        '&comment_author_url=' . urlencode( $data['comment_author_url'] ) .
        '&comment_content=' . urlencode( $data['comment_content'] );
  
    $host = $http_host = 'rest.akismet.com';
    $path = '/1.1/comment-check';
    $port = 443;
    $akismet_ua = "WordPress/4.4.1 | Akismet/3.1.7";
    $content_length = strlen( $request );
    $http_request  = "POST $path HTTP/1.0\r\n";
    $http_request .= "Host: $host\r\n";
    $http_request .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $http_request .= "Content-Length: {$content_length}\r\n";
    $http_request .= "User-Agent: {$akismet_ua}\r\n";
    $http_request .= "\r\n";
    $http_request .= $request;
  
    $response = '';
     
    if( false != ( $fs = @fsockopen( 'ssl://' . $http_host, $port, $errno, $errstr, 10 ) ) ) {
 
        fwrite( $fs, $http_request );
 
        while ( !feof( $fs ) ) {
            $response .= fgets( $fs, 1160 ); // One TCP-IP packet
        }
 
        fclose( $fs );
 
        $response = explode( "\r\n\r\n", $response, 2 );
    }
 
    if ( 'true' == $response[1] ) {
        return 'true';
    } else {
        return 'false';
    }
}

function add_ajax_entry_form() {

    check_ajax_referer( '8WEJaAMTuBqH', 'nonce' );

    global $wpdb;
    $tablename = $wpdb->prefix."entry";

    if (!class_exists('Akismet')) {
            $akismet_api_key = '116f46ee243a';  // Replace with your API key
            require_once(ABSPATH . 'wp-content/plugins/akismet/class.akismet.php');
            global $akismet_api_host, $akismet_api_port;
        }

      $userFullName = $_REQUEST['firstname'].' '.$_REQUEST['lastname'];
      $fullForm = $_REQUEST['firstname'].' '.$_REQUEST['lastname'].' '.$_REQUEST['email'].' '.$_REQUEST['phone'].' '.$_REQUEST['company_name'];

       $akismetData = array(
            'blog' => site_url(),
            'user_ip' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'referrer' => $_SERVER['HTTP_REFERER'],
            'comment_type' => 'contact-form',
            'comment_author' => sanitize_text_field($userFullName),
            'comment_author_email' => sanitize_email($_REQUEST['email']),
            'comment_content' => sanitize_text_field($fullForm), 
        );

        // Check if Akismet flags the comment as spam
       $isSpam = akismet_comment_check( '116f46ee243a', $akismetData );

        // Parse Akismet response
        if ($isSpam == 'true') {
            // Handle spam case
            $succes['validate'] = false;
            $succes['spam'] = true;
            update_option('akismet_spam_count', get_option('akismet_spam_count') + 1);
            //wp_send_json_error('Your submission was flagged as spam.');
            wp_send_json_success( $succes );
        } else {

        //$currentEmailExist = $wpdb->get_results( "SELECT `email` FROM `sw_entry` WHERE `email` = '".$_REQUEST['email']."'" );

          //if(count($currentEmailExist) == 0) {

            $insertEntry = $wpdb->insert($tablename, array(
                'firstname' => sanitize_text_field($_REQUEST['firstname']),
                'lastname' => sanitize_text_field($_REQUEST['lastname']),
                'email' => sanitize_email($_REQUEST['email']),
                'phone' => sanitize_text_field($_REQUEST['phone']),
                'contact_type' => sanitize_text_field($_REQUEST['contact_type']),
                'selected_formula' => sanitize_text_field($_REQUEST['selected_formula']),
                'company_name' => sanitize_text_field($_REQUEST['company_name']),
                'company_activity' => sanitize_text_field($_REQUEST['company_activity']),
              ));

            if($insertEntry == 1){

              $headers = array('Content-Type: text/html; charset=UTF-8;','Reply-To: '.$userFullName.' <'.sanitize_email($_REQUEST['email']).'>');
              $title = "Nouvelle proposition de partenariat - ".$userFullName;

              ob_start(); 
              ?>
                  <p>Bonjour,</p>
                  <p>Une nouvelle proposition de partenariat vient d'être envoyée via https://stickwithus.be ! Voici les infos :<br><br>
                  <b>Prénom: </b> <?php echo sanitize_text_field($_REQUEST['firstname']); ?><br>
                  <b>Nom: </b> <?php echo sanitize_text_field($_REQUEST['lastname']); ?><br>
                  <b>Email: </b> <?php echo sanitize_text_field($_REQUEST['email']); ?><br>
                  <b>GSM: </b> <?php echo sanitize_text_field($_REQUEST['phone']); ?><br>
                  <b>Partenariat: </b> <?php echo sanitize_text_field($_REQUEST['contact_type']); ?><br>
                  <b>Formule(s) choisie(s): </b> <?php echo sanitize_text_field($_REQUEST['selected_formula']); ?>
                  <?php if($_REQUEST['selected_formula'] == "Sponsor"): ?>
                    <br><b>Nom du sponsor: </b> <?php echo sanitize_text_field($_REQUEST['company_name']); ?>
                    <br><b>Secteur d'activités: </b> <?php echo sanitize_text_field($_REQUEST['company_activity']); ?>
                  <?php endif; ?>
                  </p>
                  <p>Pouvez-vous traiter cette demande et revenir rapidement vers cette personne ? Merci !</p>

              <?php

              $content = ob_get_contents();
              ob_end_clean();

              $email_sent = wp_mail( "paul-philippe@getin.agency", $title, $content, $headers);
              $succes['validate'] = true;
              wp_send_json_success( $succes );
            }
            else {
              wp_send_json_success( $error );
            }
          // }
          // else {
          //   $succes['validate'] = false;
          //   $error['emailexist'] = true;
          //   wp_send_json_success( $error );
      // }
    }

}

add_action( 'wp_ajax_add_ajax_entry_form', 'add_ajax_entry_form' );
add_action( 'wp_ajax_nopriv_add_ajax_entry_form', 'add_ajax_entry_form' );

// function add_ajax_email() {

//     global $wpdb;
//     $tablename = $wpdb->prefix."newsletters";

//     $datetime = new DateTime();
//     $timezone = new DateTimeZone('Europe/Brussels');
//     $datetime->setTimezone($timezone);
//     $creationDate = $datetime->format('Y-m-d H:i:s');

//     $voteData['wpdbResult'] = $wpdb->insert($tablename, array(
//       'created_at' => $creationDate,
//       'email' => $_REQUEST['newsletter_email']
//     ));


//     if($voteData['wpdbResult'] == 1) {
//       $succes['dbid'] = $wpdb->insert_id;
//       wp_send_json_success( $succes );
//     }
//     else {
//       $error['error_type'] = "dbsave";
//       wp_send_json_error( $error );
//     }
        
// }

// add_action( 'wp_ajax_add_ajax_email', 'add_ajax_email' );
// add_action( 'wp_ajax_nopriv_add_ajax_email', 'add_ajax_email' );

function contactmenu() {

    add_menu_page("contact", "Contact", "edit_posts", "contact", "displayMessages","dashicons-email-alt"); 

}
add_action("admin_menu", "contactmenu");


function displayMessages() {
  include "contact-page.php";
}
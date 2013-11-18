<?php
/**
 * CDN Functionality
 *
 * @user potanin@UD
 *
 * @copyright Copyright (c) 2010 - 2013, Usability Dynamics, Inc.
 *
 * @author team@UD
 * @version 0.0.1
 * @namespace UsabilityDynamics
 * @module UsabilityDynamics
 */
namespace UsabilityDynamics {

  if( !class_exists( 'UsabilityDynamics\CDN' ) ) {

    /**
     * CDN Library.
     *
     * @submodule CDN
     * @version 0.0.1
     * @class Uti lity
     */
    class CDN {

      /**
       * Loader Class version.
       *
       * @property $version
       * @type {Object}
       */
      public static $version = '0.0.3';

      public function __construct() {

        $this->client  = new \GoogleApi\Google_Client();
        //$this->service = new \GoogleApi\Books\Service( $client );

        $optParams = array( 'filter' => 'free-ebooks' );
        $results   = $service->volumes->listVolumes( 'Henry David Thoreau', $optParams );

        foreach( $results[ 'items' ] as $item ) {
          print( $item[ 'volumeInfo' ][ 'title' ] . '<br>' );
        }

      }

      function service() {

        require_once 'google-api-php-client/src/Google_Client.php';
        require_once 'google-api-php-client/src/contrib/Google_StorageService.php';
        require_once "google-api-php-client/src/contrib/Google_Oauth2Service.php";

        $client = new Google_Client();
        $client->setUseObjects( true );
        $client->setAssertionCredentials( new Google_AssertionCredentials(
            '541786531381-6fv12akl1og7v4vqquv8eko65jgbq18v@developer.gserviceaccount.com',
            array(
              'https://www.googleapis.com/auth/devstorage.full_control',
              'https://www.googleapis.com/auth/drive'
            ),
            file_get_contents( 'fae9347852cba45695fb5c686a47d8a10fb9d326-privatekey.p12' ) )
        );

        $storageService = new Google_StorageService( $client );

        echo "<pre>";
        print_r( $storageService->objects->listObjects( 'media.usabilitydynamics.com' ) );
        die();

      }
    }
  }

}

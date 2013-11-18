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

      /**
       * Google Client Instance.
       *
       * @public
       * @static
       * @property $_storage
       * @type {Object}
       */
      public $_client = null;

      /**
       * Storage Service Instance.
       *
       * @public
       * @static
       * @property $_storage
       * @type {Object}
       */
      public $_storage = null;

      /**
       * Instantiate.
       *
       * @param {object|array} $settings Cofiguration.
       * @param {string} $settings.account
       * @param {string} $settings.key
       * @param {string} $settings.scopes
       */
      public function __construct( $settings ) {

        // Normalize Settings.
        $this->settings = (object) $settings;

        // Instantiate Google Client.
        $this->_client  = new \Google_Client();

        // I don't know what this does.
        $this->_client->setUseObjects( true );

        // Set Service Credentials.
        $this->_client->setAssertionCredentials( new \Google_AssertionCredentials( $this->settings->account, (array) $this->settings->scopes, $this->settings->key ) );

        // Google Storage.
        $this->_storage = new \Google_StorageService( $this->_client );

      }

      /**
       * @param {String} $name
       *
       * @return \Google_Objects
       */
      function get_bucket( $name ) {

        return $this->_storage->objects->listObjects( $name );

      }
    }
  }

}

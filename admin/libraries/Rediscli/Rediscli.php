<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Rediscli extends CI_Driver_Library {

       public $valid_drivers = array(
           'phpredis'
       );

       public $CI;

       function __construct() {

              $this->CI = & get_instance ();

              if ( ! $this->is_supported())
              {
                     // do not support redis
                     log_message('error', 'Redis are unavailable');
              }

       }

       /**
        * Check if Redis driver is supported
        *
        * @return	bool
        */
       public function is_supported()
       {
              return extension_loaded('redis');
       }

}
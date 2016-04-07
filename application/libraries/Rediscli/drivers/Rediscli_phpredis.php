<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * PHP Redis Class
 *
 * @package	   CodeIgniter
 * @subpackage Libraries
 * @category   Core
 * @author	   Anton Lindqvist <anton@qvister.se>
 * @link
 */
class Rediscli_phpredis extends CI_Driver
{
       /**
        * Default config
        *
        * @static
        * @var	array
        */
       protected static $_default_config = array(
           'socket_type' => 'tcp',
           'host' => '127.0.0.1',
           'password' => NULL,
           'port' => 6379,
           'timeout' => 0
       );

       /**
        * Redis connection
        *
        * @var	Redis
        */
       public $redis;

       /**
        * An internal cache for storing keys of serialized values.
        *
        * @var	array
        */
       protected $_serialized = array();

       // ------------------------------------------------------------------------

       /**
        * Class constructor
        *
        * Setup Redis
        *
        * Loads Redis config file if present. Will halt execution
        * if a Redis connection can't be established.
        *
        * @return	void
        * @see		Redis::connect()
        */
       public function __construct()
       {
              $config = array();
              $CI =& get_instance();

              if ($CI->config->load('redis', TRUE, TRUE))
              {
                     $config = $CI->config->item('redis');
              }

              $config = array_merge(self::$_default_config, $config);
              $this->redis = new Redis();

              try
              {
                     if ($config['socket_type'] === 'unix')
                     {
                            $success = $this->redis->connect($config['socket']);
                     }
                     else // tcp socket
                     {
                            $success = $this->redis->connect($config['host'], $config['port'], $config['timeout']);
                     }

                     if ( ! $success)
                     {
                            log_message('error', 'Cache: Redis connection failed. Check your configuration.');
                     }

                     if (isset($config['password']) && ! $this->redis->auth($config['password']))
                     {
                            log_message('error', 'Cache: Redis authentication failed.');
                     }
              }
              catch (RedisException $e)
              {
                     log_message('error', 'Cache: Redis connection refused ('.$e->getMessage().')');
              }

              // Initialize the index of serialized values.
              $serialized = $this->redis->sMembers('_ci_redis_serialized');
              empty($serialized) OR $this->_serialized = array_flip($serialized);
       }


       /**
        * Class destructor
        *
        * Closes the connection to Redis if present.
        *
        * @return	void
        */
       public function __destruct()
       {
              if ($this->redis)
              {
                     $this->redis->close();
              }
       }
}
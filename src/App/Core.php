<?php

namespace App;

use Silex\Application;
use Symfony\Component\Filesystem\Filesystem;


class Core  {


    protected $env;
    protected $base_path;
    protected $app_path;
    protected $public_path;
    protected $storage_path;
    protected $debug;
    protected $core_instance;
    protected $database_config;
    protected $database_connection;
    protected $queue_connection;
    protected $testing;
    protected $salt;


    public function __construct()
    {
        $this->app = new \Silex\Application();
        $this->filesystem = new Filesystem();
    }

    public function setFilesystem($filesystem)
    {
        $this->filesystem = $filesystem;
        return $this;
    }

    public function getFilesystem()
    {
        return $this->filesystem;
    }

    public function getApp()
    {
        return $this->app;
    }

    public function setEnv($env = null)
    {
        if(null == $env) {
            $env = include($this->getAppPath() . '/../.env_boot.php');
            $this->env = $env;
        } else {
            $this->env = $env;
        }
        return $this;
    }

    public function getEnv()
    {
        return $this->env;
    }

    public function setTesting($testing = false)
    {
        $this->testing = $testing;
        return $this;
    }

    public function getTesting()
    {
        return $this->testing;
    }

    public function getDatabaseConfig()
    {
        return $this->database_config;
    }

    public function setDatabaseConfig($path_and_file = null)
    {
        if(null === $path_and_file)
        {
            $env = $this->getEnvWithTrailingSlash();
            $config = require_once $this->getAppPath() . '/config/' . $env . 'database.php';
            $this->database_config = $config;
        } else {
            $this->database_config = $path_and_file;
        }
        return $this;
    }

    public function getEnvWithTrailingSlash()
    {
        $env = (null == $this->getEnv()) ? '' : $this->getEnv() . '/';
        return $env;
    }


    /**
     * @return mixed
     */
    public function getStoragePath()
    {
        return $this->storage_path;
    }

    /**
     * @param mixed $storage_path
     */
    public function setStoragePath($storage_path)
    {
        $this->storage_path = $storage_path;
    }

    /**
     * @return mixed
     */
    public function getAppPath()
    {
        return $this->app_path;
    }

    /**
     * @param mixed $app_path
     */
    public function setAppPath($app_path)
    {
        $this->app_path = $app_path;
    }

    /**
     * @return mixed
     */
    public function getPublicPath()
    {
        return $this->base_path;
    }

    /**
     * @param $public_path
     * @internal param mixed $app_path
     */
    public function setPublicPath($public_path)
    {
        $this->public_path = $public_path;
    }

    /**
     * @return mixed
     */
    public function getBasePath()
    {
        return $this->base_path;
    }

    /**
     * @param mixed $base_path
     */
    public function setBasePath($base_path)
    {
        $this->base_path = $base_path;
    }

    public function setUpPaths(array $paths)
    {
        foreach($paths as $key => $value)
        {
            switch($key) {
                case 'app':
                    $this->setAppPath($value);
                    break;
                case 'base':
                    $this->setBasePath($value);
                    break;
                case 'storage':
                    $this->setStoragePath($value);
                    break;
                case 'public':
                    $this->setPublicPath($value);
                    break;
            }
        }
    }

    public function setCoreInstance($core)
    {
        $this->core_instance = $core;
    }

    public function getCoreInstance()
    {
        return $this->core_instance;
    }

    public function setQueueLogging()
    {
        if(!$this->getFilesystem()->exists($this->getStoragePath() . '/logs/core.log'))
        {
            $this->getFilesystem()->dumpFile($this->getStoragePath() . '/logs/core.log', '');
        }
        $this->getApp()->register(new \Silex\Provider\MonologServiceProvider(), array(
            'monolog.logfile' => $this->getStoragePath() . '/logs/core.log',
        ));
    }

    public function setDatabaseConnection($database_connection = null)
    {
        if(null === $database_connection)
        {
            $database_connection = require_once $this->getAppPath() . '/config/' . $this->getEnvWithTrailingSlash() . 'database.php';
            $this->database_connection = $database_connection;
        } else {
            $this->database_connection = $database_connection;
        }
        return $this;
    }

    public function getDatabaseConnection()
    {
        return $this->database_connection;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    public function getSalt()
    {
        return $this->salt;
    }
}
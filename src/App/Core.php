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

    public function __construct()
    {
        $this->app = new Application();
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

    public function setEnv($env)
    {
        $this->env = $env;
        return $this;
    }

    public function getEnv()
    {
        return $this->env;
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

}
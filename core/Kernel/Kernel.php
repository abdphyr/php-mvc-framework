<?php

namespace Abd\Mvc\Kernel;

class Kernel
{
  public $container = [];
  public static string $ROOT_DIR;

  public function __construct($root_dir)
  {
    self::$ROOT_DIR = $root_dir;
  }

  public function instance($accessor)
  {
    if (isset($this->container[$accessor])) {
      return $this->container[$accessor];
    } else {
      return null;
    }
  }

  public function bind($abstract, $concreate = null)
  {
    if ($concreate === null) {
      $this->container[$abstract] = new $abstract;
    } else {
      $this->container[$abstract] = new $concreate;
    }
  }

  protected function bindProviders()
  {
    $config_app = require_once self::$ROOT_DIR . "/config/app.php";
    // $allProviders = scandir(dirname(__DIR__) . '/Providers');
    // require_once dirname(__DIR__) . '/Providers/Provider.php';
    $providers = $config_app["providers"];
    foreach ($providers as $provider) {
      $instance = new $provider($this);
      // dd($instance);
      $instance->register();
      $instance->boot();
    }
    // dd($this);
    // dd(new $providers[0]($this));
    // dd($allProviders);
    // $class = pathinfo($allProviders[2], PATHINFO_FILENAME);
    // require_once dirname(__DIR__) . '/Providers/AuthServiceProvider.php';

    // dd(new );
    // var_dump(new $class());
    // foreach ($allProviders as $provider) {
      // if ($provider === '.' || $provider === '..') {
      //   continue;
      // }
      // require_once dirname(__DIR__) . "/Providers/$provider";
      // $class = pathinfo($provider, PATHINFO_FILENAME);
      // var_dump($provider ,$class);
      // try {
      //   $instance = new $class($this);
      //   $instance->register();
      //   $instance->boot();
      // } catch (\Throwable $th) {
        // dd($th->getMessage());
      // }
    // }
  }
  protected function bootFacedes()
  {
    $facades = scandir(dirname(__DIR__) . '/Facades');

    foreach ($facades as $facade) {
      if ($facade === '.' || $facade === '..') {
        continue;
      }
      require_once dirname(__DIR__) . "/Facades/$facade";
      $class = pathinfo($provider, PATHINFO_FILENAME);
      $class::$app = $this;
    }
  }

  public function load()
  {
    $this->bindProviders();
    // $this->bootFacedes();
  }

  public function run()
  {
    echo router()->resolve();
  }

  public function kill()
  {
    $this->container = [];
  }
}

<?php

use Faker\Factory;
use Expay\Logger\Log;
use PHPUnit\Framework\TestCase;

/**
 * LogTest
 */
class LogTest extends TestCase
{
  /**
   * faker
   *
   * @var mixed
   */
  private $faker;  
  /**
   * logger
   *
   * @var mixed
   */
  private $logger;
    
  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->logger=new Log();
    $this->faker=Factory::create();
  }
  
  /**
   * testError
   *
   * @return void
   */
  public function testError()
  {
    $string=$this->faker->word;
    $result=$this->logger->error($string);
    $this->assertEquals($result,0);
  }

  /**
   * testInfo
   *
   * @return void
   */
  public function testInfo()
  {
    $string=$this->faker->word;
    $result=$this->logger->info($string);
    $this->assertEquals($result,0);
  }

  /**
   * testSuccess
   *
   * @return void
   */
  public function testSuccess()
  {
    $string=$this->faker->word;
    $result=$this->logger->success($string);
    $this->assertEquals($result,0);
  }

  /**
   * testDebug
   *
   * @return void
   */
  public function testDebug()
  {
    $string=$this->faker->word;
    $result=$this->logger->debug($string);
    $this->assertEquals($result,0);
  }

  /**
   * testRunner
   *
   * @return void
   */
  public function testRunner()
  {
    $string=$this->faker->word;
    $result=$this->logger->runner($string);
    $this->assertEquals($result,0);
  }
}

<?php

use Faker\Factory;
use Expay\Logger\Log;
use PHPUnit\Framework\TestCase;

/**
 * LogTests
 */
class LogTests extends TestCase
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
    $this->assertIsInt($result);
  }
}

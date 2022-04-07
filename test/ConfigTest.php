<?php

namespace Test;

use ActiveRecord\Config;
use ActiveRecord\Exceptions\ConfigException;
use Test\helpers\SnakeCase_PHPUnit_Framework_TestCase;

class TestLogger
{
  private function log()
  {
  }
}

class TestDateTimeWithoutCreateFromFormat
{
  public function format($format = null)
  {
  }
}

class TestDateTime
{
  public function format($format = null)
  {
  }

  public static function createFromFormat($format, $time)
  {
  }
}

class ConfigTest extends SnakeCase_PHPUnit_Framework_TestCase
{
  public function set_up()
  {
    $this->config = new Config();
    $this->connections = ['development' => 'mysql://blah/development', 'test' => 'mysql://blah/test'];
    $this->config->set_connections($this->connections);
  }

  /**
   *
   */
  public function test_set_connections_must_be_array()
  {
    $this->expectException(ConfigException::class);
    $this->config->set_connections(null);
  }

  public function test_get_connections()
  {
    $this->assertEquals($this->connections, $this->config->get_connections());
  }

  public function test_get_connection()
  {
    $this->assertEquals($this->connections['development'], $this->config->get_connection('development'));
  }

  public function test_get_invalid_connection()
  {
    $this->assertNull($this->config->get_connection('whiskey tango foxtrot'));
  }

  public function test_get_default_connection_and_connection()
  {
    $this->config->set_default_connection('development');
    $this->assertEquals('development', $this->config->get_default_connection());
    $this->assertEquals($this->connections['development'], $this->config->get_default_connection_string());
  }

  public function test_get_default_connection_and_connection_string_defaults_to_development()
  {
    $this->assertEquals('development', $this->config->get_default_connection());
    $this->assertEquals($this->connections['development'], $this->config->get_default_connection_string());
  }

  public function test_get_default_connection_string_when_connection_name_is_not_valid()
  {
    $this->config->set_default_connection('little mac');
    $this->assertNull($this->config->get_default_connection_string());
  }

  public function test_default_connection_is_set_when_only_one_connection_is_present()
  {
    $this->config->set_connections(['development' => $this->connections['development']]);
    $this->assertEquals('development', $this->config->get_default_connection());
  }

  public function test_set_connections_with_default()
  {
    $this->config->set_connections($this->connections, 'test');
    $this->assertEquals('test', $this->config->get_default_connection());
  }

  public function test_get_date_class_with_default()
  {
    $this->assertEquals(\ActiveRecord\DateTime::class, $this->config->get_date_class());
  }

  /**
   */
  public function test_set_date_class_when_class_doesnt_exist()
  {
    $this->expectException(ConfigException::class);
    $this->config->set_date_class('doesntexist');
  }

  /**
   */
  public function test_set_date_class_when_class_doesnt_have_format_or_createfromformat()
  {
    $this->expectException(ConfigException::class);
    $this->config->set_date_class(TestLogger::class);
  }

  /**
   */
  public function test_set_date_class_when_class_doesnt_have_createfromformat()
  {
    $this->expectException(ConfigException::class);
    $this->config->set_date_class(TestDateTimeWithoutCreateFromFormat::class);
  }

  public function test_set_date_class_with_valid_class()
  {
    $this->config->set_date_class(TestDateTime::class);
    $this->assertEquals(TestDateTime::class, $this->config->get_date_class());
  }

  public function test_initialize_closure()
  {
    $test = $this;

    Config::initialize(function ($cfg) use ($test)
    {
      $test->assertNotNull($cfg);
      $test->assertEquals('ActiveRecord\Config', get_class($cfg));
    });
  }

  public function test_logger_object_must_implement_log_method()
  {
    try
    {
      $this->config->set_logger(new TestLogger());
      $this->fail();
    }
    catch (ConfigException $e)
    {
      $this->assertEquals($e->getMessage(), "Logger object must implement a public log method");
    }
  }
}

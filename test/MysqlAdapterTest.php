<?php

namespace Test;

use ActiveRecord\Column;
use ActiveRecord\Config;
use ActiveRecord\Connection;
use Test\helpers\AdapterTest;

class MysqlAdapterTest extends AdapterTest
{
  public function set_up($connection_name = null)
  {
    parent::set_up('mysql');
  }

  public function test_enum()
  {
    $author_columns = $this->conn->columns('authors');
    $this->assertEquals('enum', $author_columns['some_enum']->raw_type);
    $this->assertEquals(Column::STRING, $author_columns['some_enum']->type);
    $this->assertSame(null, $author_columns['some_enum']->length);
  }

  public function test_set_charset()
  {
    $connection_string = Config::instance()->get_connection($this->connection_name);
    $conn = Connection::instance($connection_string . '?charset=utf8');
    $this->assertEquals('SET NAMES ?', $conn->last_query);
  }

  public function test_limit_with_null_offset_does_not_contain_offset()
  {
    $ret = [];
    $sql = 'SELECT * FROM authors ORDER BY name ASC';
    $this->conn->query_and_fetch($this->conn->limit($sql, null, 1), function ($row) use (&$ret)
    {
      $ret[] = $row;
    });

    $this->assertTrue(strpos($this->conn->last_query, 'LIMIT 1') !== false);
  }
}

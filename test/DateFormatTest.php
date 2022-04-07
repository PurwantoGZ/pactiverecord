<?php

namespace Test;

use ActiveRecord\DateTime;
use Test\helpers\DatabaseTest;
use Test\models\Author;

class DateFormatTest extends DatabaseTest
{
  public function test_datefield_gets_converted_to_ar_datetime()
  {
    //make sure first author has a date
    $author = Author::first();
    $author->some_date = new DateTime();
    $author->save();

    $author = Author::first();
    $this->assert_is_a(DateTime::class, $author->some_date);
  }
}

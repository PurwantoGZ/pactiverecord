<?php

namespace Test\models;

class AwesomePerson extends \ActiveRecord\Model
{
    static $belongs_to = array('author');
}

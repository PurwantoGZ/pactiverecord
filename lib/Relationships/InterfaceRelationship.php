<?php

namespace ActiveRecord\Relationships;

use ActiveRecord\Model;

/**
 * Interface for a table relationship.
 *
 * @package ActiveRecord\relationships
 */
interface InterfaceRelationship
{
  public function __construct($options = []);

  public function build_association(Model $model, $attributes = [], $guard_attributes = true);

  public function create_association(Model $model, $attributes = [], $guard_attributes = true);
}

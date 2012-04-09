<?php

use LazyRecord\Schema\RuntimeSchema;

class TodoSchemaProxy extends RuntimeSchema
{

    public function __construct()
    {
        /** columns might have closure, so it can not be const */
        $this->columns         = array( 
  'id' => array( 
      'name' => 'id',
      'attributes' => array( 
          'type' => 'integer',
          'isa' => 'int',
          'primary' => true,
          'autoIncrement' => true,
        ),
    ),
  'title' => array( 
      'name' => 'title',
      'attributes' => array( 
          'type' => 'text',
          'isa' => 'str',
        ),
    ),
  'done' => array( 
      'name' => 'done',
      'attributes' => array( 
          'type' => 'boolean',
          'isa' => 'bool',
          'default' => false,
        ),
    ),
  'created_on' => array( 
      'name' => 'created_on',
      'attributes' => array( 
          'type' => 'timestamp',
          'isa' => 'DateTime',
          'defaultBuilder' => function() { return date('c'); },
        ),
    ),
);
        $this->columnNames     = array( 
  'id',
  'title',
  'done',
  'created_on',
);
        $this->primaryKey      = 'id';
        $this->table           = 'todos';
        $this->modelClass      = 'Todo';
        $this->collectionClass = 'TodoCollection';
        $this->label           = 'Todo';
        $this->relations       = array( 
);
    }

}

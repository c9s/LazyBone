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
          'autoIncrement' => true,
        ),
    ),
  'text' => array( 
      'name' => 'text',
      'attributes' => array( 
          'type' => 'text',
          'isa' => 'str',
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
  'text',
  'created_on',
);
        $this->primaryKey      = NULL;
        $this->table           = 'todos';
        $this->modelClass      = 'Todo';
        $this->collectionClass = 'TodoCollection';
        $this->label           = 'Todo';
        $this->relations       = array( 
);
    }

}

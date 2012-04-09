<?php 
return array( 
  'bootstrap' => array( 
      'bootstrap.php',
    ),
  'schema' => array( 
      'paths' => array( 
          'model',
        ),
    ),
  'data_sources' => array( 
      'default' => array( 
          'dsn' => 'sqlite:/tmp/todos.db',
        ),
    ),
);
?>
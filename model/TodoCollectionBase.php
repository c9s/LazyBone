<?php



class TodoCollectionBase 
extends \LazyRecord\BaseCollection
{

            const schema_proxy_class = '\\TodoSchemaProxy';
        const model_class = '\\Todo';
        const table = 'todos';
        
}

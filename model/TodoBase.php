<?php



class TodoBase 
extends \LazyRecord\BaseModel
{

            const schema_proxy_class = '\\TodoSchemaProxy';
        const collection_class = '\\TodoCollection';
        const model_class = '\\Todo';
        const table = 'todos';
        
}

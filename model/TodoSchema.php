<?php

class TodoSchema extends LazyRecord\Schema\SchemaDeclare
{
    function schema()
    {
        $this->column('id')
            ->autoIncrement()
            ->integer();

        $this->column('text')
            ->text();

        $this->column('created_on')
            ->defaultBuilder( function() { return date('c'); } )
            ->timestamp();

    }
}

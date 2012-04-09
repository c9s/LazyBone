<?php

class TodoSchema extends LazyRecord\Schema\SchemaDeclare
{
    function schema()
    {
        $this->column('id')
            ->primary()
            ->autoIncrement()
            ->integer();

        $this->column('title')
            ->text();

        $this->column('done')
            ->boolean()
            ->default(false);

        $this->column('created_on')
            ->defaultBuilder( function() { return date('c'); } )
            ->timestamp();
    }

    function bootstrap($model)
    {
        $model->create(array(
            'title' => 'Foo',
        ));
    }
}

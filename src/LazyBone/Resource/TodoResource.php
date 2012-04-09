<?php
namespace LazyBone\Resource;
use Roller\Plugin\RESTful\ResourceHandler;
use Todo;
use TodoCollection;

class TodoResource extends ResourceHandler
{
	public function create()
	{ 
        $vars = json_decode($this->readInput(),true);
		$todo = new Todo;
		$ret = $todo->create($vars);
        if( $ret->success ) {
            return $todo->toArray();
        }
        $this->codeBadRequest();
        return array( 'error' => $ret->message );
   	}

	public function update($id) 
	{
        $todo = new Todo( $id );
        if( ! $todo->id ) {
            return $this->codeNotFound();
        }

        $vars = json_decode($this->readInput(),true);
        unset( $vars['created_on'] ); // lazy record bug

        if($vars) {
            $todo->update( $vars );
            return $todo->toArray();
        }
        return $this->codeBadRequest();
   	}

	// delete a record.
    public function delete($id) 
    {
        $todo = new Todo( $id );
        $ret = $todo->delete();
        return array( 
            'success' => $ret->success,
            'id' => $id,
        );
   	}

	// load one record
	public function load($id)   
	{
		$todo = new Todo( $id );
		return $todo->toArray();
   	}

	// find records
	public function find()      
	{ 
		$todos = new TodoCollection;
		return $todos->toArray();
	}

}


<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class Repository implements RepositoryInterface
{
    // model property on class instances
    protected $model, $request;

    protected $modelPaginationPerPge = 50;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all(array $data = array(), Request $request = null, array $dataIn = array(), $dataInColumn = null)
    {
        if (count($data) > 0 && count($dataIn) == 0)
        {
          $this->request = $request;
          return $this->filterdata($data);
        }
        elseif (count($dataIn) > 0 && $dataInColumn != null)
        {
          $this->request = $request;
          return $this->filterDataArrayInput($data,$dataIn,$dataInColumn);
        }
        else
        {
          return $this->model->orderBy($this->model->getKeyName(), 'desc')->paginate($this->modelPaginationPerPge);
        }
    }
	
	
    public function filterdata($data)
    {
        $input = $this->request->input();
        return $this->model->where($data)->paginate($this->modelPaginationPerPge)->appends($input);
    }
	
	public function filterDataArrayInput($data,$dataIn,$dataInColumn)
    {
      $input = $this->request->input();
      return $this->model->whereIn($dataInColumn, $dataIn)->where($data)->paginate($this->modelPaginationPerPge)->appends($input);
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $findRecord = $this->model->find($id);
        $findRecord->fill($data);

        return $findRecord->save();
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }


}
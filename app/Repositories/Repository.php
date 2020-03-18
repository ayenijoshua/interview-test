<?php
namespace App\Repositories;

//use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface {

    protected $model;

    function __construct(Model $model){
        $this->model = $model;
    }
    
    public function create(array $data){
       return $this->model->create($array);
    }

    public function all(){
        return $this->model->all();
    }

    public function get($id){
        return $this->model->find($id);
    }

    public function update($id,$data){
       return $this->model->find($id)->update($data);
    }

    public function delete($id){
        return $this->model->destroy($id);
    }

    /**
     * get model instance
     */
    public function getModel(){
        return $this->model;
    }

    /**
     * set model instance
     */
    public function setModel($model){
        return $this->model = $model;
    }

    /**
     * eager load relations
     */
    public function with($relations){
        return $this->model->with($relations);
    }
}
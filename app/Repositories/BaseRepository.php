<?php
    namespace App\Repositories;
    use Illuminate\Database\Eloquent\Model;
    class BaseRepository implements BaseRepositoryInterface
    {
        protected $model;
        public function __construct(Model $model)
        {
            $this->model = $model;
        }
        public function getAll()
        {
            return $this->model->all();
        }
        public function getPaginate($value)
        {
            return $this->model->paginate($value);
        }
        public function getCreate($data)
        {
            return $this->model->create($data);
        }
        public function getId($id)
        {
            return $this->model->findOrFail($id);
        }
        public function getIdSingle($item,$operator,$id)
        {
            return $this->model->where($item,$operator,$id)->first();
        }
        public function getIdAll($item,$operator,$id)
        {
            return $this->model->where($item,$operator,$id)->get();
        }
        public function getWherePaginate($item,$operator,$data,$value)
        {
            return $this->model->where($item,$operator,$data)->paginate($value);
        }
        public function getUpdate($id,$data)
        {   $value = $this->getId($id);
            return $value->update($data);
        }
        public function getDelete($id)
        {   $value = $this->getId($id);
            return $value->delete();
        }
        public function getSearch($search,$item1,$item2,$value)
        {
            return $this->model->where(function($query) use($search,$item1,$item2,$value){
                $query->where($item1,'LIKE',"%".$search."%")
                    ->orWhere($item2,'LIKE',"%".$search."%");
            })->paginate($value);
        }
    }
?>

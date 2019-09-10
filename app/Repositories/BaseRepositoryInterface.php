<?php
    namespace App\Repositories;
    interface BaseRepositoryInterface
    {
        public function getAll();
        public function getPaginate($value);
        public function getCreate($data);
        public function getId($id);
        public function getIdSingle($item,$operator,$id);
        public function getIdAll($item,$operator,$id);
        public function getUpdate($id,$data);
        public function getDelete($id);
        public function getSearch($search,$item1,$item2,$value);
        public function getWherePaginate($item,$operator,$data,$value);
    }
?>

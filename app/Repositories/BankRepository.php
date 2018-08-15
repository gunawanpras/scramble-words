<?php

namespace App\Repositories;
use illuminate\Database\Eloquent\Model;


class BankRepository implements RepositoryInterface {
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }
    
    public function all() {
        return $this->model->all();
    }

    public function show($id) {}
    public function create(array $data) {}
    public function update(array $data, $id) {}
    public function delete($id) {}

    public function getWordsByLevel($current_level, $current_level_words) {
        return $this->model->select('word')
                    ->where('level', '=', $current_level)
                    ->whereNotIn('word', $current_level_words)
                    ->orderBy('word', 'ASC')
                    ->get();
    }
}
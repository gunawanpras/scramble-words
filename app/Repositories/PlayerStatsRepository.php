<?php

namespace App\Repositories;
use illuminate\Database\Eloquent\Model;

class PlayerStatsRepository implements RepositoryInterface {
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }
    
    public function all() {
        return $this->model->all();
    }

    public function show($user_id) {
        return $this->model->join('users', 'player_stats.user_id', '=', 'users.id')
                            ->select('player_stats.*', 'users.email')
                            ->where('player_stats.user_id', '=', $user_id)
                            ->get();
    }
    
    public function create(array $data) {}
    public function update(array $data, $id) {}
    public function delete($id) {}    
}
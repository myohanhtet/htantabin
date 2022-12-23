<?php

namespace App\Repositories;

use App\Repositories\Contract\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Find resource.
     *
     * @param mixed $id
     * @return Model
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create new resource.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update existing resource.
     *
     * @param mixed $id
     * @param array $data
     * @return Model
     */
    public function update($id, array $data)
    {
        $add = $this->model->find($id);
        $add->update($data);
        return $add;
    }

    /**
     * Delete existing resource.
     *
     * @param mixed $id
     * @return bool
     */
    public function delete($id): bool
    {
       $data = $this->model->find($id);
        return (bool)$data->delete();
    }
}

<?php

namespace App\Repositories\Contract;

use Illuminate\Database\Eloquent\Model;

interface InvoiceInterface
{
    /**
     * Find resource.
     *
     * @param mixed $id
     * @return Model
     */
    public function find($id): Model;

    /**
     * Create new resource.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * Update existing resource.
     *
     * @param mixed $id
     * @param array $data
     * @return Model
     */
    public function update($id, array $data): Model;

    /**
     * Delete existing resource.
     *
     * @param mixed $id
     * @return bool
     */
    public function delete($id): bool;

    public function emptyLuckyNumber($amount);

    public function searchByColumn($column,$value);
}

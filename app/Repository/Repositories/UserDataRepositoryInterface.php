<?php


namespace App\Repository\Repositories;


interface UserDataRepositoryInterface
{
    public function first();

    public function create($data);

    public function update($id, $data);

    public function delete($id);
}

<?php


namespace App\Repository\Entities;


use App\Repository\Repositories\UserDataRepositoryInterface;
use App\UserData;

class UserDataRepository implements UserDataRepositoryInterface
{
    public function first()
    {
        return UserData::first();
    }

    public function create($data)
    {
        $params = [
            'name' => $data['name'],
            'profession' => $data['profession'],
            'params' => $data['params']
        ];
        return UserData::create([
            'user_id' => rand(1, 100),
            'params' => $params
        ]);
    }

    public function delete($id)
    {
        $data = UserData::findOrFail($id);
        return $data->delete();
    }

    public function update($id, $data)
    {
        $currentData = UserData::findOrFail($id);
        $currentData->updateData($data);
        return $currentData;
    }
}

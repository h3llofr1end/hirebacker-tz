<?php


namespace App\Http\Controllers;


use App\Repository\Repositories\UserDataRepositoryInterface;

class UserDataController extends Controller
{
    protected $userDataRepository;

    public function __construct(UserDataRepositoryInterface $userDataRepository)
    {
        $this->userDataRepository = $userDataRepository;
    }

    public function first()
    {
        $userData = $this->userDataRepository->first();
        return response()->json($userData, 200);
    }

    public function update($id)
    {
        $userData = $this->userDataRepository->update($id, request()->all());
        return response()->json($userData, 200);
    }

    public function create()
    {
        $userData = $this->userDataRepository->create(request()->all());
        return response()->json($userData, 201);
    }

    public function delete($id)
    {
        $this->userDataRepository->delete($id);
        return response()->json([], 204);
    }
}

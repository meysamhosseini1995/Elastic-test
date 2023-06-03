<?php


namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    public array $selectableList = ['id','name','email'];


    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }
}

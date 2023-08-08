<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'email', 'password','phone', 'wallet','otp','active', 'created_at'];

    public function store($username, $email, $password)
    {
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ];
        $this->insert($data);
    }

    public function list()
    {
        return $this->findAll();
    }
    public function getUserById($userId)
    {
        return $this->find($userId);
    }
    public function increaseWalletAmount($userId, $amount)
    {
         $currentUser = $this->find($userId);
        $currentWalletAmount = $currentUser['wallet']; 
         $newWalletAmount = $currentWalletAmount + $amount; 
        $this->update($userId, ['wallet' => $newWalletAmount]);
        return $userId;
    }
 
}
   
 

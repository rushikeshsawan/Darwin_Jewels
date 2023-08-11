<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'email', 'password', 'phone', 'otp', 'wallet', 'active', 'created_at'];

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
    public function getWalletBalanceByUsername($id)
    {
        return $this->select('wallet')
            ->where('id', $id) // Use 'username' instead of 'id'
            ->get()
            ->getRow('wallet');
    }
  
}

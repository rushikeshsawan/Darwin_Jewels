<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $allowedFields = ['username', 'email', 'password', 'otp', 'created_at'];

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

    public function updateOTP($adminId, $otp)
    {
        $data = [
            'otp' => $otp,
        ];
        $this->update($adminId, $data);
    }

    public function updateAdmin($adminId, $data)
    {
        $this->update($adminId, $data);
    }
}

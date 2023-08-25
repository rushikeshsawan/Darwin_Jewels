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
<<<<<<< HEAD
   
}
=======

    public function updateAdmin($adminId, $data)
    {
        $this->update($adminId, $data);
    }
    public function getAddedAdminsCountLast7Days()
    {
        return $this->where('created_at >=', date('Y-m-d', strtotime('-7 days')))
                    ->countAllResults();
    }
    public function getTotalAdminsCount()
    {
        return $this->countAllResults();
    }
}
   
 
>>>>>>> 29f8a3b4fa91203b78951bc36a687aad21b112b9

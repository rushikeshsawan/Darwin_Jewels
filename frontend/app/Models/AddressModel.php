<?php

namespace App\Models;

use CodeIgniter\Model;

class AddressModel extends Model
{
    protected $table = 'address';
    protected $allowedFields = ['user_id', 'name', 'address', 'mobile', 'email', 'zip'];
    protected $validationRules = [
        'user_id' => 'required',
        'name' => 'required',
        'address' => 'required',
        'mobile' => 'required|exact_length[10]',
        'email' => 'required|valid_email',
        'zip' => 'required'
    ];

    protected $validationMessages = [
        'user_id' => [
            'required' => 'The user ID field is required.'
        ],
        'name' => [
            'required' => 'The name field is required.'
        ],
        'address' => [
            'required' => 'The address field is required.'
        ],
        'mobile' => [
            'required' => 'The mobile number field is required.',
            'exact_length[10]' => 'The mobile number length is exact 10.' 
        ],
        'email' => [
            'required' => 'The email field is required.',
            'valid_email' => 'Please provide a valid email address.'
        ],
        'zip' => [
            'required' => 'The zip field is required.'
        ]
    ];

    public function insertAddress($data)
    {
        $this->insert($data);
        return $this->affectedRows() === 1;
    }
}

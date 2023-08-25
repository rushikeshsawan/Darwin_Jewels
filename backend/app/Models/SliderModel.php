<?php

namespace App\Models;

use CodeIgniter\Model;

class SliderModel extends Model
{
    protected $table = 'slider';
    protected $primaryKey = 'id';
    protected $allowedFields = ['image', 'main_heading', 'sub_heading'];

    public function list()
    {
        return $this->findAll();
    } 
    public function store($main_heading, $image, $sub_heading)
    {
        $data = [
            'main_heading' => $main_heading,
            'sub_heading' => $sub_heading,
            'image' => $image, 
        ];
        $this->insert($data);
    }
    public function updateSlider($id, $main_heading, $sub_heading, $imageName)
    {
        $data = [
            'main_heading' => $main_heading,
            'sub_heading' => $sub_heading,
            'image' => $imageName
        ];
        $this->update($id, $data);
    }
    public function getSliderImage($id)
    {
        return $this->db->table('slider')
            ->select('image')
            ->where('id', $id)
            ->get()
            ->getRow('image');
    }
}

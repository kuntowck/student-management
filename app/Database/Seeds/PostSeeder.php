<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Post pertama',
                'content' => 'Ini konten pertama',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Post kedua',
                'content' => 'Ini konten kedua',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('posts');
    }
}

<?php

namespace App\Controllers;

use PDO;

class Home extends BaseController
{
    public function index()
    {
        // return view('welcome_message');

        try {
            $db = \config\Database::connect();
            $builder = $db->table('student');

            $db->initialize();

            if ($db->connID) {
                echo 'Koneksi database berhasil: ';
                print_r($db->getDatabase());
                echo '<br>';
            }

            $query = $db->query('SELECT * FROM student');
            $queryWhere = "SELECT * FROM student WHERE id = :id:";
            $queryInsert = "INSERT INTO student (name, status, age) VALUES (?, ?, ?)";
            $queryUpdate = "UPDATE student SET age = ? WHERE id  = ?";

            // foreach ($query->getResult() as $row) {
            //     d($row);
            //     d($row->id);
            //     d($row->name);
            //     d($row->status);
            //     d($row->age);
            // }

            // foreach ($query->getResult('array') as $row) {
            //     d($row);
            //     d($row['id']);
            //     d($row['name']);
            //     d($row['status']);
            //     d($row['age']);
            // }

            // $db->query($sqlInsert, ['kunto', 'active', '22']);

            // $db->query($sqlUpdate, [27, 1]);

            // $query = $db->query($sqlWhere, ['id' => 1]);
            // foreach ($query->getResult('array') as $row) {
            //     d($row);
            // }

            // d($query->getRow(1));

            // $query = $builder->get();
            // foreach ($query->getResult() as $row) {
            //     d($row);
            // }

            // $builder->select('id, name');
            // $query1 = $builder->get();
            // foreach ($query1->getResult() as $row) {
            //     d($row);
            // }

            // $builder->where('id', 1);
            // $query = $builder->get();
            // d($query->getRow());

            $builder->select('nim, name, entry_year, study');
            $query = $builder->get();
            foreach ($query->getResult('array') as $row) {
                d($row);
                $row['nim'];
                $row['name'];
                $row['entry_year'];
                $row['study'];
            }

            $builder->where('status', 'Inactive');
            $query = $builder->get();
            foreach ($query->getResult('array') as $row) {
                d($row);
                $row['nim'];
                $row['name'];
                $row['entry_year'];
                $row['study'];
            }
            
            $builder->select('nim, name, entry_year, study');
            $builder->orderBy('nim', 'ASC');
            $query = $builder->get();
            foreach ($query->getResult('array') as $row) {
                d($row);
                $row['nim'];
                $row['name'];
                $row['entry_year'];
                $row['study'];
            }

        } catch (\Exception $e) {
            echo "error: " . $e->getMessage();
        }
    }
}

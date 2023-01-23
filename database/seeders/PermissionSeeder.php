<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // role
        // Permission::create(['name' => 'role list']);
        // Permission::create(['name' => 'role edit']);
        // Permission::create(['name' => 'role create']);
        // Permission::create(['name' => 'role delete']);

        // // school
        // Permission::create(['name' => 'school list']);
        // Permission::create(['name' => 'school edit']);
        // Permission::create(['name' => 'school create']);
        // Permission::create(['name' => 'school delete']);

        // //gradeStudent
        // Permission::create(['name' => 'gradeStudent list']);
        // Permission::create(['name' => 'gradeStudent edit']);
        // Permission::create(['name' => 'gradeStudent create']);
        // Permission::create(['name' => 'gradeStudent delete']);

        // //lab
        // Permission::create(['name' => 'lab list']);
        // Permission::create(['name' => 'lab edit']);
        // Permission::create(['name' => 'lab create']);
        // Permission::create(['name' => 'lab delete']);

        // //teacher
        // Permission::create(['name' => 'teacher list']);
        // Permission::create(['name' => 'teacher edit']);
        // Permission::create(['name' => 'teacher create']);
        // Permission::create(['name' => 'teacher delete']);

        // //course
        // Permission::create(['name' => 'courses list']);
        // Permission::create(['name' => 'courses edit']);
        // Permission::create(['name' => 'courses create']);
        // Permission::create(['name' => 'courses delete']);

        // //AcademicSession
        // Permission::create(['name' => 'academicSession list']);
        // Permission::create(['name' => 'academicSession edit']);
        // Permission::create(['name' => 'academicSession create']);
        // Permission::create(['name' => 'academicSession delete']);
        // //AcademicSession
        // Permission::create(['name' => 'student list']);
        // Permission::create(['name' => 'student edit']);
        // Permission::create(['name' => 'student create']);
        // Permission::create(['name' => 'student delete']);

        // //museum
        // Permission::create(['name' => 'museum list']);
        // Permission::create(['name' => 'museum edit']);
        // Permission::create(['name' => 'museum create']);
        // Permission::create(['name' => 'museum delete']);

        // //permission
        // Permission::create(['name' => 'museumItem list']);
        // Permission::create(['name' => 'museumItem edit']);
        // Permission::create(['name' => 'museumItem create']);
        // Permission::create(['name' => 'museumItem delete']);

        // //permission
        // Permission::create(['name' => 'permission list']);
        // Permission::create(['name' => 'permission edit']);
        // Permission::create(['name' => 'permission create']);
        // Permission::create(['name' => 'permission delete']);
        // //news
        // Permission::create(['name' => 'news list']);
        // Permission::create(['name' => 'news edit']);
        // Permission::create(['name' => 'news create']);
        // Permission::create(['name' => 'news delete']);
        // //management
        // Permission::create(['name' => 'management list']);
        // Permission::create(['name' => 'management edit']);
        // Permission::create(['name' => 'management create']);
        // Permission::create(['name' => 'management delete']);
        // //certificate
        // Permission::create(['name' => 'certificate list']);
        // Permission::create(['name' => 'certificate edit']);
        // Permission::create(['name' => 'certificate create']);
        // Permission::create(['name' => 'certificate delete']);
        //certificate
        Permission::create(['name' => 'project list']);
        Permission::create(['name' => 'project edit']);
        Permission::create(['name' => 'project create']);
        Permission::create(['name' => 'project delete']);
    }
}

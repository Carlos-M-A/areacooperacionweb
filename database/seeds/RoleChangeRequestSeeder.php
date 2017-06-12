<?php

use Illuminate\Database\Seeder;
use App\RoleChangeRequest;
use App\Teacher;

class RoleChangeRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('RoleChangeRequest')->delete();
        
        $roleChangeRequest = new RoleChangeRequest();
        $roleChangeRequest->id = 6;
        $roleChangeRequest->currentRole = 1;
        $roleChangeRequest->newRole = 2;
        $roleChangeRequest->save();
        
        $teacher = new Teacher();
        $teacher->id = 6;
        $teacher->areasOfInterest = 'Areas interes cambio rol estu a doce';
        $teacher->departments = 'departamentos cambio de rol estudiante a teacher';
        $teacher->save();
        
        DB::table('Study_Teacher')->insert([
            'teacher_id' => 6,
            'study_id' => 1,
        ]);
        DB::table('Study_Teacher')->insert([
            'teacher_id' => 6,
            'study_id' => 2,
        ]);
    }
}

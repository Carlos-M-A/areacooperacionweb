<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('User')->delete();
        
        $user = new User;
        $user->name = 'Administrador';
        $user->surnames = 'Apellidos admin';
        $user->email = 'administrador@email.com';
        $user->password = bcrypt('123456');
        $user->idCard = 'adminDNI';
        $user->phone = 'adminTel';
        $user->role = 6;
        $user->accepted = true;
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->lastConnectionDate = new \DateTime();
        $user->createdDate = new \DateTime();
        $user->removed = false;
        $user->save();
        
        
        $user = new User;
        $user->name = 'Área de Cooperación';
        $user->surnames = 'Área de Cooperacion Internacional para el Desarrollo de la Universidad de Valladaolid';
        $user->email = 'areacooperacion@email.com';
        $user->password = bcrypt('123456');
        $user->idCard = 'areaDNI';
        $user->phone = 'areaTel';
        $user->role = 5;
        $user->accepted = true;
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->lastConnectionDate = new \DateTime();
        $user->createdDate = new \DateTime();
        $user->removed = false;
        $user->save();
        
        $user = new User;
        $user->name = 'Organizacion';
        $user->surnames = 'Social name org';
        $user->email = 'organizacion@email.com';
        $user->password = bcrypt('123456');
        $user->idCard = 'orgDNI';
        $user->phone = 'orgTel';
        $user->role = 4;
        $user->accepted = false;
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->lastConnectionDate = new \DateTime();
        $user->createdDate = new \DateTime();
        $user->removed = false;
        $user->save();
        
        $user = new User;
        $user->name = 'Otro';
        $user->surnames = 'Apellidos otro';
        $user->email = 'otro@email.com';
        $user->password = bcrypt('123456');
        $user->idCard = 'otroDNI';
        $user->phone = 'otroTel';
        $user->role = 3;
        $user->accepted = false;
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->lastConnectionDate = new \DateTime();
        $user->createdDate = new \DateTime();
        $user->removed = false;
        $user->save();
        
        $user = new User;
        $user->name = 'Docente';
        $user->surnames = 'Apellidos doce';
        $user->email = 'docente@email.com';
        $user->password = bcrypt('123456');
        $user->idCard = 'docenteDNI';
        $user->phone = 'docenteTel';
        $user->role = 2;
        $user->accepted = false;
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->lastConnectionDate = new \DateTime();
        $user->createdDate = new \DateTime();
        $user->removed = false;
        $user->save();
        
        $user = new User;
        $user->name = 'Estudiante';
        $user->surnames = 'Apellidos estu';
        $user->email = 'estudiante@email.com';
        $user->password = bcrypt('123456');
        $user->idCard = 'estudianteDNI';
        $user->phone = 'estudianteTel';
        $user->role = 1;
        $user->accepted = false;
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->lastConnectionDate = new \DateTime();
        $user->createdDate = new \DateTime();
        $user->removed = false;
        $user->save();
        
        
        
        $user = new User;
        $user->name = 'Organizacion gestionada 1';
        $user->surnames = 'social name 1';
        $user->email = 'organizacionGes1@email.com';
        $user->password = bcrypt('123456');
        $user->idCard = 'orgDNI1';
        $user->phone = 'orgTel1';
        $user->role = 4;
        $user->accepted = false;
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->lastConnectionDate = new \DateTime();
        $user->createdDate = new \DateTime();
        $user->removed = false;
        $user->save();
        
        $user = new User;
        $user->name = 'Organizacion gestionada 2';
        $user->surnames = 'social name 2';
        $user->email = 'organizacionGes2@email.com';
        $user->password = bcrypt('123456');
        $user->idCard = 'orgDNI2';
        $user->phone = 'orgTel2';
        $user->role = 4;
        $user->accepted = false;
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->lastConnectionDate = new \DateTime();
        $user->createdDate = new \DateTime();
        $user->removed = false;
        $user->save();
        
        
    }
}

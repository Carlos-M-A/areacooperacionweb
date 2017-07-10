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
        $user->surnames = '';
        $user->email = 'administrador@email.com';
        $user->password = bcrypt('123456');
        $user->idCard = 'asdfasdf';
        $user->phone = 'asdfasdf';
        $user->role = 6;
        $user->accepted = true;
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->createdDate = new \DateTime();
        $user->removed = false;
	$user->urlAvatar = null;
        $user->save();
        
        
        $user = new User;
        $user->name = 'Área de Cooperación';
        $user->surnames = 'Área de Cooperacion Internacional para el Desarrollo de la Universidad de Valladaolid';
        $user->email = 'areacooperacion@email.com';
        $user->password = bcrypt('123456');
        $user->idCard = 'dfdfdffd';
        $user->phone = 'dfdfdfffd';
        $user->role = 5;
        $user->accepted = true;
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->createdDate = new \DateTime();
        $user->removed = false;
	$user->urlAvatar = 'avatars/areacoop.png';
        $user->save();
        
        /*
        $user = new User;
        $user->name = 'Azacan';
        $user->surnames = 'ONG Azacan';
        $user->email = 'organizacion@email.com';
        $user->password = bcrypt('123456');
        $user->idCard = '23242342d';
        $user->phone = '95234512º';
        $user->role = 4;
        $user->accepted = true;
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->createdDate = new \DateTime();
        $user->removed = false;
	$user->urlAvatar = 'avatars/azacan.png';
        $user->save();
        
        $user = new User;
        $user->name = 'Pedro';
        $user->surnames = 'Rodriguez Almunia';
        $user->email = 'otro@email.com';
        $user->password = bcrypt('123456');
        $user->idCard = '23422342D';
        $user->phone = '43422323';
        $user->role = 3;
        $user->accepted = false;
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->createdDate = new \DateTime();
        $user->removed = false;
	$user->urlAvatar = 'avatars/luis.jpeg';
        $user->save();
        
        $user = new User;
        $user->name = 'Laura';
        $user->surnames = 'Pascual Hernandez';
        $user->email = 'docente@email.com';
        $user->password = bcrypt('123456');
        $user->idCard = '894038290K';
        $user->phone = '664323343';
        $user->role = 2;
        $user->accepted = true;
        $user->isObservatoryMember = true;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->createdDate = new \DateTime();
        $user->removed = false;
	$user->urlAvatar = 'avatars/laura.png';
        $user->save();
        
        $user = new User;
        $user->name = 'Carmen';
        $user->surnames = 'Sanzoles Torre';
        $user->email = 'estudiante@email.com';
        $user->password = bcrypt('123456');
        $user->idCard = '48903992L';
        $user->phone = '603394554';
        $user->role = 1;
        $user->accepted = true;
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->createdDate = new \DateTime();
        $user->removed = false;
	$user->urlAvatar = 'avatars/carmen.png';
        $user->save();
        
        
        
        $user = new User;
        $user->name = 'ACPP';
        $user->surnames = 'Asamblea de Cooperación Por la Paz';
        $user->email = 'organizacionGes1@email.com';
        $user->password = bcrypt('123456');
        $user->idCard = 'G-484838383';
        $user->phone = '916399440';
        $user->role = 4;
        $user->accepted = true;
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->createdDate = new \DateTime();
        $user->removed = false;
	$user->urlAvatar = 'avatars/acpp.jpg';
        $user->save();
        
        $user = new User;
        $user->name = 'Oxfam';
        $user->surnames = 'Oxfam intermon ONG';
        $user->email = 'organizacionGes2@email.com';
        $user->password = bcrypt('123456');
        $user->idCard = 'G-23452343';
        $user->phone = '937193484';
        $user->role = 4;
        $user->accepted = true;
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->createdDate = new \DateTime();
        $user->removed = false;
	$user->urlAvatar = 'avatars/oxfam.jpg';
        $user->save();
        
        $user = new User;
        $user->name = 'Carlos';
        $user->surnames = 'Torrecilla Asunción';
        $user->email = 'estudiante2@email.com';
        $user->password = bcrypt('123456');
        $user->idCard = '48934432L';
        $user->phone = '603394523';
        $user->role = 1;
        $user->accepted = true;
        $user->isObservatoryMember = true;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->createdDate = new \DateTime();
        $user->removed = false;
	$user->urlAvatar = 'avatars/carlos.jpeg';
        $user->save();
        */
        
    }
}

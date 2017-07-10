<?php

use Illuminate\Database\Seeder;
use App\Offer;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('Offer')->delete();
        
            $offer = new Offer();
            $offer->organization_id = 3;
            $offer->managedByArea = true;
            $offer->isOfferOfConvocatory = false;
            $offer->open = true;
            $offer->title = 'Desarrollo de aplicación web para gestión de las donaciones de libros en biblioteca';
            $offer->scope = 'Educación al desarrollo';
            $offer->description = 'Disponemos de un local donde guardamos libros que son donados. Después estos libros los donamos a bibliotecas de paises del sur. Todo esto conlleva una carga de gestión elevada. Por ello necesitamos ayuda en el desarrollo de una aplicación web que nos permita gestionar todos estos libros y sus envios';
            $offer->requeriments = 'Conocimientos en algún lenguaje web y en gestión de servidores';
            $offer->workplan = 'No hay un plan definido. El estudiante se marcará su propia planificación.';
            $offer->workplace = 'Puedes realiar las prácticas en casa. Pero tendrás que pasar por nuestro local 1 vez cada 2 semanas. En calle Carmelo, 1. Valladolid';
            $offer->schedule = 'El que te quieras poner. Pero cuando vengas al local de 9:00 a 14:00, de lunes a viernes.';
            $offer->totalHours = 'Las que necesites, pero creemos que entorno a als 300 horas';
            $offer->possibleStartDates = 'Cualquier dia de febrero';
            $offer->possibleEndDates = 'Antes del 15 de julio de 2018';
            $offer->places = 1;
            $offer->monetaryHelp = 'No damos ayuda económica';
            $offer->personInCharge = 'Jesús Anselmo Llorente';
            $offer->createdDate = new \DateTime();
            $offer->deadline = '2018-2-15';
	    $offer->save();
            
            
            $offer = new Offer();
            $offer->organization_id = 3;
            $offer->managedByArea = false;
            $offer->isOfferOfConvocatory = false;
            $offer->open = true;
            $offer->title = 'Ayuda en la creación de un huerto ecológico';
            $offer->scope = 'Ecologismo';
            $offer->description = 'Desde Azacan queremos crear un huerto ecológico en un terreno que disponemos en Valladolid. Tenemos pensado que sea un huerto colaborativo y cuyos productos resultantes no sean objeto de venta, si no de consumo de los propios productores colaboradores. Necesitamos a 2 personas con los suficientes conocimientos en agricultura para que nos ayuden a iniciar este huerto de manera fructifera';
            $offer->requeriments = 'Tener conocimientos en el cultivo agronomo, ya sea por cuenta propia o por estudiar alguna carrera que te forme en esos conocimientos';
            $offer->workplan = 'Aconsejar sobre el trabajo a realizar, compra de productos, supervisar el trabajo y ayudar en el trabajo físico';
            $offer->workplace = 'Calle Nueva, Numero 2, Valladolid';
            $offer->schedule = 'De 10:00 a 14:00, de lunes a jueves';
            $offer->totalHours = '300, aunque nos podemos adaptar a otra cantidad de horas';
            $offer->possibleStartDates = 'Puedes empezar desde febrero como pronto y el 10 de marzo como tarde';
            $offer->possibleEndDates = 'Antes de 30 de junio';
            $offer->places = 2;
            $offer->monetaryHelp = '1200 € por las 300 horas';
            $offer->personInCharge = 'Jose Ramon Luis Perez';
            $offer->createdDate = new \DateTime();
            $offer->deadline = '2018-2-15';
	    $offer->save();
            
            $offer = new Offer();
            $offer->organization_id = 7;
            $offer->managedByArea = true;
            $offer->isOfferOfConvocatory = true;
            $offer->open = true;
            $offer->title = 'Monitor/a de educación para la salud. ';
            $offer->scope = 'Salud e higiene';
            $offer->description = 'El voluntariado del proyecto colabora en la planificación, ejecución y evaluación de talleres y actividades lúdico-educativas sobre afectividad y sexualidad, VIH, prevención de consumo de drogas y hábitos alimentarios saludables y Trastornos Alimenticios en institutos, asociaciones juveniles, centros cívicos,…con grupos de entre 10 y 25 usuarios/as con edades comprendidas entre los 14 y 20 años.';
            $offer->requeriments = 'Preferible formación relacionada con la educación y lo social: magisterio, trabajo social, psicología, psicopedagogía, educación especial, integración social, terapeuta ocupacional, dietética, auxiliar de clínica, atención sociosanitaria, enfermería, escuelas-taller relacionadas';
            $offer->workplan = 'Actividades de formación/Educación, Apoyo en oficinas/Gestión/Administración, Campañas/Sensibilización/Denuncia, VIH/Sida';
            $offer->workplace = 'Calle colina, n 3, Merida, Venezuela';
            $offer->schedule = 'De 8 a 12';
            $offer->totalHours = '334';
            $offer->possibleStartDates = 'Junio';
            $offer->possibleEndDates = 'Septiembre';
            $offer->places = 1;
            $offer->monetaryHelp = '233€';
            $offer->personInCharge = 'Luisa Fernanda de Lucas';
            $offer->createdDate = new \DateTime();
            $offer->deadline = '2017-7-15';
	    $offer->save();
            
            $offer = new Offer();
            $offer->organization_id = 8;
            $offer->managedByArea = true;
            $offer->isOfferOfConvocatory = false;
            $offer->open = true;
            $offer->title = 'Sensibilización consumo de drogas';
            $offer->scope = 'Addicciones';
            $offer->description = '• Intervenir con adolescentes y jóvenes que se encuentran consumiendo alcohol u otras drogas en fiestas de los diferentes distritos de Madrid.
• Sensibilizar y concienciar sobre los efectos y consecuencias del consumo de drogas para poder reducir los riesgos asociados.
• Realizar actividades lúdico-educativas para trabajar de forma práctica efectos y riesgos del consumo de drogas.';
            $offer->requeriments = 'Mayor de 18 años';
            $offer->workplan = 'No hay';
            $offer->workplace = 'Calle bogota, 2, Valladolid';
            $offer->schedule = 'Mañanas';
            $offer->totalHours = '234 horas';
            $offer->possibleStartDates = '12 de julio';
            $offer->possibleEndDates = '23 de enero de 2018';
            $offer->places = 1;
            $offer->monetaryHelp = 'Nada';
            $offer->personInCharge = 'Felipe luis anselmo';
            $offer->createdDate = new \DateTime();
            $offer->deadline = '2018-2-15';
	    $offer->save();
            
            $offer = new Offer();
            $offer->organization_id = 7;
            $offer->managedByArea = true;
            $offer->isOfferOfConvocatory = false;
            $offer->open = true;
            $offer->title = 'Colaboración en escuela infantil con niños discapacitados';
            $offer->scope = 'Educación al desarrollo';
            $offer->description = 'Disponemos de un local donde guardamos libros que son donados. Después estos libros los donamos a bibliotecas de paises del sur. Todo esto conlleva una carga de gestión elevada. Por ello necesitamos ayuda en el desarrollo de una aplicación web que nos permita gestionar todos estos libros y sus envios';
            $offer->requeriments = 'Conocimientos en algún lenguaje web y en gestión de servidores';
            $offer->workplan = 'No hay un plan definido. El estudiante se marcará su propia planificación.';
            $offer->workplace = 'Puedes realiar las prácticas en casa. Pero tendrás que pasar por nuestro local 1 vez cada 2 semanas. En calle Carmelo, 1. Valladolid';
            $offer->schedule = 'El que te quieras poner. Pero cuando vengas al local de 9:00 a 14:00, de lunes a viernes.';
            $offer->totalHours = 'Las que necesites, pero creemos que entorno a als 300 horas';
            $offer->possibleStartDates = 'Cualquier dia de febrero';
            $offer->possibleEndDates = 'Antes del 15 de julio de 2018';
            $offer->places = 1;
            $offer->monetaryHelp = 'No damos ayuda económica';
            $offer->personInCharge = 'Jesús Anselmo Llorente';
            $offer->createdDate = new \DateTime();
            $offer->deadline = '2018-2-15';
	    $offer->save();
            
            $offer = new Offer();
            $offer->organization_id = 8;
            $offer->managedByArea = true;
            $offer->isOfferOfConvocatory = false;
            $offer->open = true;
            $offer->title = 'Creación de un aula para el ejecicio físico de personas mayores';
            $offer->scope = 'Educación al desarrollo';
            $offer->description = 'Disponemos de un local donde guardamos libros que son donados. Después estos libros los donamos a bibliotecas de paises del sur. Todo esto conlleva una carga de gestión elevada. Por ello necesitamos ayuda en el desarrollo de una aplicación web que nos permita gestionar todos estos libros y sus envios';
            $offer->requeriments = 'Conocimientos en algún lenguaje web y en gestión de servidores';
            $offer->workplan = 'No hay un plan definido. El estudiante se marcará su propia planificación.';
            $offer->workplace = 'Puedes realiar las prácticas en casa. Pero tendrás que pasar por nuestro local 1 vez cada 2 semanas. En calle Carmelo, 1. Valladolid';
            $offer->schedule = 'El que te quieras poner. Pero cuando vengas al local de 9:00 a 14:00, de lunes a viernes.';
            $offer->totalHours = 'Las que necesites, pero creemos que entorno a als 300 horas';
            $offer->possibleStartDates = 'Cualquier dia de febrero';
            $offer->possibleEndDates = 'Antes del 15 de julio de 2018';
            $offer->places = 1;
            $offer->monetaryHelp = 'No damos ayuda económica';
            $offer->personInCharge = 'Jesús Anselmo Llorente';
            $offer->createdDate = new \DateTime();
            $offer->deadline = '2018-2-15';
	    $offer->save();
            
            $offer = new Offer();
            $offer->organization_id = 3;
            $offer->managedByArea = true;
            $offer->isOfferOfConvocatory = false;
            $offer->open = true;
            $offer->title = 'Ayuda humanitaria en Siria';
            $offer->scope = 'Educación al desarrollo';
            $offer->description = 'Disponemos de un local donde guardamos libros que son donados. Después estos libros los donamos a bibliotecas de paises del sur. Todo esto conlleva una carga de gestión elevada. Por ello necesitamos ayuda en el desarrollo de una aplicación web que nos permita gestionar todos estos libros y sus envios';
            $offer->requeriments = 'Conocimientos en algún lenguaje web y en gestión de servidores';
            $offer->workplan = 'No hay un plan definido. El estudiante se marcará su propia planificación.';
            $offer->workplace = 'Puedes realiar las prácticas en casa. Pero tendrás que pasar por nuestro local 1 vez cada 2 semanas. En calle Carmelo, 1. Valladolid';
            $offer->schedule = 'El que te quieras poner. Pero cuando vengas al local de 9:00 a 14:00, de lunes a viernes.';
            $offer->totalHours = 'Las que necesites, pero creemos que entorno a als 300 horas';
            $offer->possibleStartDates = 'Cualquier dia de febrero';
            $offer->possibleEndDates = 'Antes del 15 de julio de 2018';
            $offer->places = 1;
            $offer->monetaryHelp = 'No damos ayuda económica';
            $offer->personInCharge = 'Jesús Anselmo Llorente';
            $offer->createdDate = new \DateTime();
            $offer->deadline = '2018-2-15';
	    $offer->save();
            
            $offer = new Offer();
            $offer->organization_id = 3;
            $offer->managedByArea = true;
            $offer->isOfferOfConvocatory = false;
            $offer->open = true;
            $offer->title = 'Colaboración en creación de cooperativa en Venezuela';
            $offer->scope = 'Educación al desarrollo';
            $offer->description = 'Disponemos de un local donde guardamos libros que son donados. Después estos libros los donamos a bibliotecas de paises del sur. Todo esto conlleva una carga de gestión elevada. Por ello necesitamos ayuda en el desarrollo de una aplicación web que nos permita gestionar todos estos libros y sus envios';
            $offer->requeriments = 'Conocimientos en algún lenguaje web y en gestión de servidores';
            $offer->workplan = 'No hay un plan definido. El estudiante se marcará su propia planificación.';
            $offer->workplace = 'Puedes realiar las prácticas en casa. Pero tendrás que pasar por nuestro local 1 vez cada 2 semanas. En calle Carmelo, 1. Valladolid';
            $offer->schedule = 'El que te quieras poner. Pero cuando vengas al local de 9:00 a 14:00, de lunes a viernes.';
            $offer->totalHours = 'Las que necesites, pero creemos que entorno a als 300 horas';
            $offer->possibleStartDates = 'Cualquier dia de febrero';
            $offer->possibleEndDates = 'Antes del 15 de julio de 2018';
            $offer->places = 1;
            $offer->monetaryHelp = 'No damos ayuda económica';
            $offer->personInCharge = 'Jesús Anselmo Llorente';
            $offer->createdDate = new \DateTime();
            $offer->deadline = '2018-2-15';
	    $offer->save();
    }
}

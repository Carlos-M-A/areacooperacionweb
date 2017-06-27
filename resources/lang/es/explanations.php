<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Explanations Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the strings with the explanations
    | of some data and actions in views
    */
    
    // Offers and convocatories
    'evaluate_inscription' => 'Vas a evaluar una inscripción a la convocatoria.'
            . ' Recuerda que si el estado de la inscripción no es aceptado, el estudiante no podrá apuntarse a ofertas de esta convocatoria',
    'not_accepted_in_convocatory' => 'No estas aceptado en la convocatoria de la que depende esta oferta. Por eso no puedes apuntarte en esta oferta',
    
    // Projects
    'finish_project' => 'Vas a marcar el proyecto como terminado, lo que significa que el autor finalizó el trabajo.'
            . ' Solo necesitas añadir en link a la documentación o memoria del proyecto',
    'no_author_has_been_chosen' => 'Ningún autor ha sido elegido',
    
    // Profile
    'not_accepted' => 'Tu solicitud de registro ha sido guardada, pero todavía no has sido aceptado en la aplicación. '
    . 'Cuando seas aceptado podrás acceder',
    'image_avatar_requeriments' => 'La imagen que vas a subir debe que tener las siguientes propiedades:'
        . '<ul>'
            . '<li>Menos de '. config('constants.max_size_of_images').' KB de tamaño.</li>'
            . '<li>Máximo '. config('constants.max_width_height_images').' pixeles de ancho y '. config('constants.max_width_height_images').' pixeles de alto.</li>'
        . '</ul>',
    'pdf_curriculum_requeriments' => 'El curriculum que vas a subir debe que tener las siguientes propiedades:'
        . '<ul>'
            . '<li>Debe ser un PDF: Solo se admiten archivos con formato pdf.</li>'
            . '<li>Menos de '. config('constants.max_size_of_curriculums').' KB de tamaño.</li>'
        . '</ul>',
    
    // Users
    'removed_user' => 'Este usuario fue eliminado',
    'phone_field' => 'El telefono no es un campo obligatorio, pero será de gran ayuda cuando sea necesario contactar contigo.',
    
    
    
];

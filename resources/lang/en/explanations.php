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
    'evaluate_inscription' => 'You are going to evaluate a inscription in this convocatory.',
    'not_accepted_in_convocatory' => 'You are not accepted in the convocatory of this offer, That is why you can not enroll in this offer',
    
    // Projects
    'finish_project' => 'You are going to finish this project. This meaning that the author have terminate the project. '
    . 'Only need to add the link to the documentation of the project.',
    'no_author_has_been_chosen' => 'No author has been chosen',
    
    // Profile
    'not_accepted' => 'Your registration request are saved, but you are not accepted yet in the system. When you will be accepted you will be able to use the application',
    'image_avatar_requeriments' => 'The image that you are going to upload must have these propierties:'
        . '<ul>'
            . '<li>Less than '. config('constants.max_size_of_images').' KB of size.</li>'
            . '<li>Maximun '. config('constants.max_width_height_images').' pixels of width and '. config('constants.max_width_height_images').' pixels of height.</li>'
        . '</ul>',
    'pdf_curriculum_requeriments' => 'The curriculum that you are going to upload must have these propierties:'
        . '<ul>'
            . '<li>Must be a PDF: Only is admited pdf format.</li>'
            . '<li>Less than '. config('constants.max_size_of_curriculums').' KB of size.</li>'
        . '</ul>',
    
    // Users
    'removed_user' => 'This user was removed',
    
    
    
];

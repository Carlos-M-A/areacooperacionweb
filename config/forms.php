<?php

 /*
    |--------------------------------------------------------------------------
    | Conditions for the inputs in forms
    |--------------------------------------------------------------------------
    |
    | - Max lengths of the strings
    | 
    | 
    |
    | 
    |
    */

return [

    // Max lengths of strings in forms
    'url' => 200, // For all url that links with external web page
    'file_name' => 100, // For all file that is saved in our server
    'scope' => 100,
    
    // Users
    'user_name' => 100,
    'email' => 190, // Never put more than 190 because cause a error in MySQL
    'password' => 100,
    'idCard' => 20,
    'phone' => 20,
    'surnames' => 100,
    'areasOfInterest' => 1000,
    'skills' => 2000,
    'departments' => 1000,
    'other_description' => 1000,
    'organization_description' => 2000,
    'socialName' => 200,
    'headquartersLocation' => 200,
    'linksWithNearbyEntities' => 1000,
    
    //Faculties and studies
    'faculty_name' => 100,
    'study_name' => 100,
    'city' => 100,
    
    //offers and proposals
    'offer_title' => 200,
    'offer_description' => 2000,
    'requeriments' => 1000,
    'workplan' => 1000,
    'schedule' => 1000,
    'offer_totalHours' => 200,
    'possibleStartDates' => 200,
    'possibleEndDates' => 200,
    'monetaryHelp' => 500,
    'personInCharge' => 200,
    'housing' => 1000,
    'costs' => 1000,
    'proposal_description' => 500,
    'scheduleAvailable' => 500,
    'proposal_totalHours' => 200,
    'earliestStartDate' => 200,
    'latestEndDate' => 200,
    
    //convocatories and inscriptions
    'convocatory_title' => 200,
    'information' => 2000,
    'estimatedPeriod' => 500,
    'observations' => 500,
    
    //projects and inscriptions in project
    'project_title' => 200,
    'project_description' => 1000,
    'tutor' => 200,
    'author' => 200,
    'comment' => 500,
];

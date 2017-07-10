<?php

 /*
    |--------------------------------------------------------------------------
    | Conditions for the inputs in forms
    |--------------------------------------------------------------------------
    |
    | - Max lengths of the strings
    | - Max and mins for numbers
    | 
    |
    | 
    |
    */

return [

    // Max lengths of strings in forms
    'url' => 250, // For all url that links with external web page
    'file_name' => 250, // For all file that is saved in our server
    'scope' => 100,
    
    // Users
    'user_name' => 100,
    'email' => 190, // Never put more than 190 because cause a error in MySQL
    'password' => 100,
    'idCard' => 20, // Never put more than 190 because cause a error in MySQL
    'phone' => 20,
    'surnames' => 100,
    'areasOfInterest' => 1000,
    'skills' => 2000,
    'departments' => 1000,
    'user_description' => 2000, // For organizations and other, who have the description attribute
    'socialName' => 200,
    'headquartersLocation' => 250,
    'linksWithNearbyEntities' => 250,
    
    //Campus and studies
    'campus_name' => 100,
    'study_name' => 100,
    'abbreviation' => 10,
    
    //offers and proposals
    'offer_title' => 100,
    'offer_description' => 2000,
    'requeriments' => 1000,
    'workplan' => 1000,
    'workplace' => 250,
    'schedule' => 250,
    'offer_totalHours' => 250,
    'possibleStartDates' => 250,
    'possibleEndDates' => 250,
    'monetaryHelp' => 250,
    'personInCharge' => 250,
    'housing' => 250,
    'costs' => 250,
    'proposal_description' => 250,
    'scheduleAvailable' => 250,
    'proposal_totalHours' => 250,
    'earliestStartDate' => 250,
    'latestEndDate' => 250,
    
    //convocatories and inscriptions
    'convocatory_title' => 200,
    'information' => 2000,
    'estimatedPeriod' => 250,
    'observations' => 250,
    
    //projects and inscriptions in project
    'project_title' => 200,
    'project_description' => 1000,
    'tutor' => 200,
    'author' => 200,
    'comment' => 250,
    
    //Max of places in offers
    'max_places' => 100,
];

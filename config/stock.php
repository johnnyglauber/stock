<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Stock Configuration
    |--------------------------------------------------------------------------
    |
    */

    /*
    |--------------------------------------------------------------------------
    | FK data_source_id for source at the Web App
    |--------------------------------------------------------------------------
    |
    | Set Id of Foreign Key for data entered from the Web Application
    |
    */
    'fk_web' => env('FK_WEB', 1),

    /*
    |--------------------------------------------------------------------------
    | FK data_source_id for source at the API
    |--------------------------------------------------------------------------
    |
    | Set Id of Foreign Key for data entered from the API
    |
    */
    'fk_api' => env('FK_API', 2),

    /*
    |--------------------------------------------------------------------------
    | FK stock_movement_type_id for entry type of movement
    |--------------------------------------------------------------------------
    |
    | Set Id of Foreign Key for placement of products into the stock
    |
    */
    'fk_placed' => env('FK_PLACED', 1),

    /*
    |--------------------------------------------------------------------------
    | FK stock_movement_type_id for withdrawal type of movement
    |--------------------------------------------------------------------------
    |
    | Set Id of Foreign Key for products removal from the stock
    |
    */
    'fk_removed' => env('FK_REMOVED', 2),
];

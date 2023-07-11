<?php

return [

    /*
    |--------------------------------------------------------------------------
    | permissions that compnay choose when create his users
    |--------------------------------------------------------------------------
    |
    */
    'super_admin'=>[
            //start locations permissions
            'locations'=>[
                'create_city',
                'edit_city',
                'delete_city',
                'view_city',
                'create_area',
                'edit_area',
                'delete_area',
                'view_area'
            ],

            //start settings permissions
            // 'settings'=>[
            //     'view_settings',
            //     'edit_general_settings',
            // ],
            //end settings permissions


            //start shipment permissions
            'shipment'=>[
                'create_shipment',
                'edit_shipment',
                'delete_shipment',
                'view_shipment',
            ],
            //end shipment permissions

            //start companies permissions
            'companies'=>[
                'create_companies',
                'edit_companies',
                'delete_companies',
                'view_companies',
            ],
            //end companies permissions

            //start branches permissions
            'branches'=>[
                'create_branches',
                'edit_branches',
                'delete_branches',
                'view_branches',
            ],
            //end branches permissions

            //start departments permissions
            'departments'=>[
                'create_departments',
                'edit_departments',
                'delete_departments',
                'view_departments',
            ],
            //end departments permissions

            //start receivers permissions
            'receivers'=>[
                'create_receivers',
                'edit_receivers',
                'delete_receivers',
                'view_receivers',
                'receivers_details',
            ],
            //end receivers permissions

            //start price_tables permissions
            'price_tables'=>[
                'create_price_tables',
                'edit_price_tables',
                'delete_price_tables',
                'view_price_tables',
            ],
            //end price_tables permissions

            //start shipment_status permissions
            'shipment_status'=>[
                'create_shipment_status',
                'edit_shipment_status',
                'delete_shipment_status',
                'view_shipment_status',
                'view_shipment_status_images',
            ],
            //end shipment_status permissions

            //start users permissions
            'users'=>[
                'create_users',
                'edit_users',
                'delete_users',
                'view_users',
                'view_users_details',
            ],
            //end users permissions
    ],
    'company'=>[
        //start users permissions
        'users'=>[
            'create_users',
            'edit_users',
            'delete_users',
            'view_users',
            'view_users_details',
        ],
        //end users permissions

        //start receivers permissions
        'receivers'=>[
            'create_receivers',
            'edit_receivers',
            'delete_receivers',
            'view_receivers',
            'receivers_details',
        ],
        //start departments permissions
        'departments'=>[
            'create_departments',
            'edit_departments',
            'delete_departments',
            'view_departments',
        ],
        'branches'=>[
            'create_branches',
            'edit_branches',
            'delete_branches',
            'view_branches',
        ],
        //start shipment permissions
        'shipment'=>[
            'create_shipment',
            'edit_shipment',
            'delete_shipment',
            'view_shipment',
        ],
        //end shipment permissions
    ],

];

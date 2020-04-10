<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => '',

    'title_prefix' => 'Pelos & Patas',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Pelos</b>Patas',

    'logo_mini' => '<b>P</b>P',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue-light',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => 'fixed',

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'MAIN NAVIGATION',
        [  
            'text' => 'Home',
            'icon' => 'home',
            'url'  => 'home',
        ],
        [
            'text'    => 'Menu',
            'icon'    => 'heartbeat',
            'url'     => '#',  
        ],
        [
            'text'   => 'Clientes',
            'icon'   => 'user-o',
            'submenu'=> [
                            [
                                'text'=>'Criar Cliente',
                                'url' =>'index_cliente',
                                'icon'=>'user-plus',
                            ],
                            [
                                'text'=>'Pacientes',
                                'url' =>'paciente',
                                'icon'=>'paw',
                            ]      
                        ]
        ], 
        [
            'text'    => 'Eventos',
            'icon'    => 'calendar',
            'url'     => 'calendario',  
        ],
        [
            'text'        => 'Messagens',
            'url'         => 'email/all',
            'icon'        => 'envelope-open',
        ],        
        [
            
            'text'        => 'Extract',
            'url'         => 'report/index',
            'icon'        => 'long-arrow-down',
            'submenu'     => [
                [
                    'text'  => 'My Reports',
                    'url'   => 'report/index',
                    'icon'  => 'warning',

                ],
                [
                    'text'  => 'New Report',
                    'url'   => 'report/new',
                    'icon'  => 'file-text-o',

                ],
            ]
        ],
        [
        'text' => 'Reporte',
        'icon'        => 'bar-chart',
        'submenu'=>[
                    [
                     'text'=> 'Movimentos',
                     'url'  => 'report_produt',
                            
                    ],
                    [
                     'text'=> 'Stock Atual',
                     'url'  => 'report_stock_atual',
                            
                    ],
                    [ 
                        'text' => 'Vendas',
                        'submenu' =>[
                                        [
                                         'text'=> 'Inflow',
                                         'url'  => 'report_inflow',
                                                
                                        ],   
                                        [
                                         'text'=> 'Tipo de Pagamento',
                                         'url'  => 'report_pagamento',
                                                
                                        ],                                        
                                        [
                                         'text'=> 'Produtos',
                                         'url'  => 'report_produto_venda',
                                                
                                        ],  
                                        [
                                         'text'=> 'Auditar',
                                         'url'  => 'report_auditar',
                                                
                                        ],  
                                        [
                                         'text'=> 'Vendas a Credito',
                                         'url'  => 'report_vendacredito',
                                                
                                        ],   
                                        [
                                         'text'=> 'Detalhes Banho ',
                                         'url'  => 'report_vendacar',
                                                
                                        ],                       

                                    ]

                    ]                                          
                   ]
    ],

        'Administração',
        [
            'text'       => 'Produtos',
            'icon'       => 'shopping-bag',
            'url'        => 'admin',
            'submenu'    => [
                            
                                [
                                    'text' => 'Cadastro',
                                    'url'  => 'produto',
                                    'icon' => 'plus-square-o',
                                ],
                                [
                                    'text' => 'Entradas',
                                    'url'  => 'produto_entrada',
                                ],
                                [
                                    'text' => 'Ajustes',
                                    'url'  => 'ajust_index',
                                ],
                                        
                            ], 
        ],

        [
            'text'      => 'Salas',
            'icon'      =>  'folder-open',
            'submenu'   => [
                            [
                                'text' => 'Cadastro',
                                'url'  => 'criarmesa',
                            ],

                        ],
        ],
    'Admin',
        [
            'text'    => 'Configurações',
            'icon'    => 'cog',
            'url'  => 'admin',
            
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        //JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        App\MyMenuFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
    ],
];

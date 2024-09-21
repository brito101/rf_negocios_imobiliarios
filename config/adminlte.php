<?php

use Illuminate\Support\Facades\Auth;

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => '',
    'title_prefix' => env('APP_NAME'),
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => true,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => env('APP_NAME_SHORT'),
    'logo_img' => 'img/brand-white.webp',
    'logo_img_class' => 'brand-image elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => env('APP_NAME_SHORT'),

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => false,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => true,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => true,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'admin',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => false, //'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'Pesquisar',
        ],
        //Custom menus
        [
            'text' => 'Dashboard',
            'url' => '/admin',
            'icon' => 'fa fa-fw fa-digital-tachograph mr-2',
        ],
        [
            'text' => 'Usuários',
            'url' => '#',
            'icon' => 'fas fa-fw fa-users mr-2',
            'can' => 'Acessar Usuários',
            'submenu' => [
                [
                    'text' => 'Listagem de Usuários',
                    'url' => 'admin/users',
                    'icon' => 'fas fa-fw fa-chevron-right',
                    'can' => 'Listar Usuários',
                ],
                [
                    'text' => 'Cadastro de Usuários',
                    'url' => 'admin/users/create',
                    'icon' => 'fas fa-fw fa-chevron-right',
                    'can' => 'Criar Usuários',
                ],
            ],
        ],
        [
            'text' => 'Agências',
            'url' => '#',
            'icon' => 'fas fa-fw fa-building mr-2',
            'can' => 'Acessar Agências',
            'submenu' => [
                [
                    'text' => 'Listagem de Agências',
                    'url' => 'admin/agencies',
                    'icon' => 'fas fa-fw fa-chevron-right',
                    'can' => 'Listar Agências',
                ],
                [
                    'text' => 'Cadastro de Agências',
                    'url' => 'admin/agencies/create',
                    'icon' => 'fas fa-fw fa-chevron-right',
                    'can' => 'Criar Agências',
                ],
            ],
        ],
        [
            'text' => 'Clientes',
            'url' => '#',
            'icon' => 'fas fa-fw fa-user-plus mr-2',
            'can' => 'Acessar Clientes',
            'submenu' => [

                [
                    'text' => 'Listagem de Clientes',
                    'url' => 'admin/clients',
                    'icon' => 'fas fa-fw fa-chevron-right',
                    'can' => 'Listar Clientes',
                ],
                [
                    'text' => 'Cadastro de Clientes',
                    'url' => 'admin/clients/create',
                    'icon' => 'fas fa-fw fa-chevron-right',
                    'can' => 'Criar Clientes',
                ],
                [
                    'text' => 'Funil de Clientes',
                    'url' => 'admin/clients-funnel',
                    'icon' => 'fas fa-fw fa-chevron-right',
                    'can' => 'Listar Clientes',
                ],
            ],
        ],
        [
            'text' => 'Propriedades',
            'url' => '#',
            'icon' => 'fas fa-fw fa-home mr-2',
            'can' => 'Acessar Propriedades',
            'submenu' => [
                [
                    'text' => 'Listagem de Propriedades',
                    'url' => 'admin/properties',
                    'icon' => 'fas fa-fw fa-chevron-right',
                    'can' => 'Listar Propriedades',
                ],
                [
                    'text' => 'Cadastro de Propriedade',
                    'url' => 'admin/properties/create',
                    'icon' => 'fas fa-fw fa-chevron-right',
                    'can' => 'Criar Propriedades',
                ],
            ],
        ],
        [
            'text' => 'Configurações',
            'url' => '#',
            'icon' => 'fas fa-fw fa-cog mr-2',
            'can' => 'Acessar Configurações',
            'submenu' => [
                [
                    'text' => 'Etapas de Prospecção',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-shoe-prints mr-2',
                    'can' => 'Acessar Etapas',
                    'submenu' => [
                        [
                            'text' => 'Listagem de Etapas',
                            'url' => 'admin/steps',
                            'icon' => 'fas fa-fw fa-chevron-right',
                            'can' => 'Listar Etapas',
                        ],
                        [
                            'text' => 'Cadastro de Etapas',
                            'url' => 'admin/steps/create',
                            'icon' => 'fas fa-fw fa-chevron-right',
                            'can' => 'Criar Etapas',
                        ],
                    ],
                ],
                [
                    'text' => 'Categorias',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-tag mr-2',
                    'can' => 'Acessar Categorias',
                    'submenu' => [
                        [
                            'text' => 'Listagem de Categorias',
                            'url' => 'admin/categories',
                            'icon' => 'fas fa-fw fa-chevron-right',
                            'can' => 'Listar Etapas',
                        ],
                        [
                            'text' => 'Cadastro de Categoria',
                            'url' => 'admin/categories/create',
                            'icon' => 'fas fa-fw fa-chevron-right',
                            'can' => 'Criar Etapas',
                        ],
                    ],
                ],
                [
                    'text' => 'Tipos',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-circle mr-2',
                    'can' => 'Acessar Tipos',
                    'submenu' => [
                        [
                            'text' => 'Listagem de Tipos',
                            'url' => 'admin/types',
                            'icon' => 'fas fa-fw fa-chevron-right',
                            'can' => 'Listar Tipos',
                        ],
                        [
                            'text' => 'Cadastro de Tipo',
                            'url' => 'admin/types/create',
                            'icon' => 'fas fa-fw fa-chevron-right',
                            'can' => 'Criar Tipos',
                        ],
                    ],
                ],
                [
                    'text' => 'Diferenciais',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-list mr-2',
                    'can' => 'Acessar Diferenciais',
                    'submenu' => [
                        [
                            'text' => 'Listagem de Diferenciais',
                            'url' => 'admin/differentials',
                            'icon' => 'fas fa-fw fa-chevron-right',
                            'can' => 'Listar Diferenciais',
                        ],
                        [
                            'text' => 'Cadastro de Diferencial',
                            'url' => 'admin/differentials/create',
                            'icon' => 'fas fa-fw fa-chevron-right',
                            'can' => 'Criar Diferenciais',
                        ],
                    ],
                ],
                [
                    'text' => 'Experiências',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-cloud mr-2',
                    'can' => 'Acessar Experiências',
                    'submenu' => [
                        [
                            'text' => 'Listagem de Experiências',
                            'url' => 'admin/experiences',
                            'icon' => 'fas fa-fw fa-chevron-right',
                            'can' => 'Listar Etapas',
                        ],
                        [
                            'text' => 'Cadastro de Experiência',
                            'url' => 'admin/experiences/create',
                            'icon' => 'fas fa-fw fa-chevron-right',
                            'can' => 'Criar Etapas',
                        ],
                    ],
                ],
            ],
        ],
        [
            'text' => 'ACL',
            'icon' => 'fas fa-fw fa-user-shield mr-2',
            'can' => 'Acessar ACL',
            'submenu' => [

                [
                    'text' => 'Listagem de Perfis',
                    'url' => 'admin/role',
                    'icon' => 'fas fa-fw fa-chevron-right',
                    'can' => 'Listar Perfis',
                ],
                [
                    'text' => 'Cadastro de Perfis',
                    'url' => 'admin/role/create',
                    'icon' => 'fas fa-fw fa-chevron-right',
                    'can' => 'Criar Perfis',
                ],
                [
                    'text' => 'Listagem de Permissões',
                    'url' => 'admin/permission',
                    'icon' => 'fas fa-fw fa-chevron-right',
                ],
                [
                    'text' => 'Cadastro de Permissões',
                    'url' => 'admin/permission/create',
                    'icon' => 'fas fa-fw fa-chevron-right',
                    'can' => 'Criar Permissões',
                ],
            ],
        ],
        [
            'text' => 'Changelog',
            'url' => 'admin/changelog',
            'icon' => 'fas fa-fw fa-code mr-2',
        ],
        [
            'text' => 'Site',
            'url' => '/',
            'icon' => 'fas fa-fw fa-link mr-2',
            'target' => '_blank',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'DatatablesPlugins' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.html5.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.print.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/jszip/jszip.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/pdfmake.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/vfs_fonts.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/chart.js/Chart.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'vendor/chart.js/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'BsCustomFileInput' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bs-custom-file-input/bs-custom-file-input.min.js',
                ],
            ],
        ],
        'select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/select2/js/select2.full.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2/css/select2.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css',
                ],
            ],
        ],
        'Summernote' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/summernote/summernote-bs4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/summernote/summernote-bs4.min.css',
                ],
            ],
        ],
        'BootstrapSelect' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];

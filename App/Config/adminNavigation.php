<?php
return [
    'adminNavigation' => [
          'name' => 'Home',
          'link' => 'admin/dashboard/index/',
          'attr' => [
              'class' => 'uk-margin-small-right' ,
              'data' => 'data-uk-icon="icon: home"'
          ]
    ],
   /* [
        'name' => 'Projects',
        'link' => null ,
        'attr' => [
            'class' => 'uk-parent' ,
            'data' => 'data-uk-icon="icon: list"'
        ],
        'sub-nav' => [

            'list' => [
                ['name' => 'Project',
                    'link' => 'admin/project/index/',
                    'attr' => ['class' => 'uk-parent' , 'data' => 'data-uk-icon="icon:  chevron-double-right"'],
                ],
                ['name' => 'Client',
                    'link' => 'admin/client/index/',
                    'attr' => ['class' => 'uk-parent' , 'data' => 'data-uk-icon="icon: chevron-double-right"'],
                ],
                ['name' => 'Task',
                    'link' => 'admin/task/index/',
                    'attr' => ['class' => 'uk-parent' , 'data' => 'data-uk-icon="icon: chevron-double-right"'],
                ],
                ['name' => 'Activity',
                    'link' => 'admin/activity/index/',
                    'attr' => ['class' => 'uk-parent' , 'data' => 'data-uk-icon="icon: chevron-double-right"'],
                ],
            ]
        ],

    ],*/
    [
        'name' => 'Tickets',
        'link' => 'admin/ticket/index/',
        'attr' => [
            'class' => 'uk-margin-small-right' ,
            'data' => 'data-uk-icon="icon: warning"'
        ]
    ],
    [
        'name' => 'Projects',
        'link' => 'admin/project/index/',
        'attr' => [
            'class' => 'uk-margin-small-right' ,
            'data' => 'data-uk-icon="icon: bag"'
        ]
    ],
    [
        'name' => 'Clients',
        'link' => 'admin/client/index/',
        'attr' => [
            'class' => 'uk-margin-small-right' ,
            'data' => 'data-uk-icon="icon:  user"'
        ]
    ],
    [
        'name' => 'Tasks',
        'link' => 'admin/task/index/',
        'attr' => [
            'class' => 'uk-margin-small-right' ,
            'data' => 'data-uk-icon="icon: bell"'
        ]
    ],
    [
        'name' => 'Activities',
        'link' => 'admin/activity/index/',
        'attr' => [
            'class' => 'uk-margin-small-right' ,
            'data' => 'data-uk-icon="icon: code"'
        ]
    ],
    [
        'name' => 'Users',
        'link' => 'admin/user/index/',
        'attr' => [
            'class' => 'uk-margin-small-right' ,
            'data' => 'data-uk-icon="icon: users"'
        ]
    ],
    [
         'name' => 'Messages',
         'link' => 'admin/message/index/',
         'attr' => [
             'class' => 'uk-margin-small-right' ,
             'data' => 'data-uk-icon="icon: comments"'
         ]
     ],
    [
         'name' => 'Reports',
         'link' => null ,
         'attr' => [
             'class' => 'uk-parent' ,
             'data' => 'data-uk-icon="icon: album"'
         ],

         'sub-nav' => [

             'list' => [

                    ['name' => 'Report',
                     'link' => 'admin/report/index/',
                     'attr' => ['class' => 'uk-parent' , 'data' => 'data-uk-icon="icon: chevron-double-right"'],
                    ]

                 ]
         ],

    ],
    [
        'name' => 'Settings',
        'link' => null ,
        'attr' => [
            'class' => 'uk-parent' ,
            'data' => 'data-uk-icon="icon: settings"'
        ],
        'sub-nav' => [

           'list' => [
                ['name' => 'Role',
                    'link' => 'admin/role/index/',
                    'attr' => ['class' => 'uk-parent' , 'data' => 'data-uk-icon="icon: chevron-double-right"'],
                ],
                ['name' => 'Permission',
                    'link' => 'admin/permission/index/',
                    'attr' => ['class' => 'uk-parent' , 'data' => 'data-uk-icon="icon: chevron-double-right"'],
                ],
                ['name' => 'RolePermission',
                    'link' => 'admin/rolePermission/index/',
                    'attr' => ['class' => 'uk-parent' , 'data' => 'data-uk-icon="icon: chevron-double-right"'],
                ],
           ]
        ],

    ],
    [
        'name' => 'Dev',
        'link' => null ,
        'attr' => [
            'class' => 'uk-parent' ,
            'data' => 'data-uk-icon="icon: git-branch"'
        ],
        'sub-nav' => [

            'list' => [
                ['name' => 'Git',
                    'link' => 'admin/git/index/',
                    'attr' => ['class' => 'uk-parent' , 'data' => 'data-uk-icon="icon: chevron-double-right"'],
                ],
                ['name' => 'GitHub',
                    'link' => 'admin/gitHub/index/',
                    'attr' => ['class' => 'uk-parent' , 'data' => 'data-uk-icon="icon: chevron-double-right"'],
                ],
            ]
        ],

    ]
];

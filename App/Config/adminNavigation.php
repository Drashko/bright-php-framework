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
    [
        'name' => 'User',
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

                    ['name' => 'User report',
                     'link' => 'admin/report/index/',
                     'attr' => ['class' => 'uk-parent' , 'data' => 'data-uk-icon="icon: comments"'],
                    ],
                    ['name' => 'Statistic',
                     'link' => 'admin/report/index/',
                     'attr' => ['class' => 'uk-parent' , 'data' => 'data-uk-icon="icon: comments"'],
                    ],
                 ]
         ],

    ],
    [
        'name' => 'Settings',
        'link' => null ,
        'attr' => [
            'class' => 'uk-parent' ,
            'data' => 'data-uk-icon="icon: thumbnails"'
        ],
        'sub-nav' => [

           'list' => [
                ['name' => 'Role',
                    'link' => 'admin/role/index/',
                    'attr' => ['class' => 'uk-parent' , 'data' => 'data-uk-icon="icon: comments"'],
                ],
                ['name' => 'Permission',
                    'link' => 'admin/permission/index/',
                    'attr' => ['class' => 'uk-parent' , 'data' => 'data-uk-icon="icon: comments"'],
                ],
                ['name' => 'RolePermission',
                    'link' => 'admin/rolePermission/index/',
                    'attr' => ['class' => 'uk-parent' , 'data' => 'data-uk-icon="icon: comments"'],
                ],
           ]
        ],

    ]
        /*'templates' => [
            'article' => 'Article',
            'album' => 'Album',
            'cover' => 'Cover',
            'cart' => 'Cart',
            'newsBlog' => 'News Blog',
            'price' => 'Price',
        ],*/

   // ]
];

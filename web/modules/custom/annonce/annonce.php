<?php

use Drupal\Core\Database\Database;

function hello_schema(){


$schema['hello_user_statistics'] = [
    'description' => 'Stores user connection statistics.',
    'fields' => [
      'id' => [
        'description' => 'Primary Key: Unique history ID.',
        'type' => 'serial',
        'unsigned' => TRUE,
        'not null' => TRUE,
      ],
      'time' => [
        'description' => 'Timestamp of user action.',
        'type' => 'int',
        'unsigned' => TRUE,
        'not null' => TRUE,
      ],

        'uid'=> ['description'=> 'uid.',
            'type'=> 'int',
            'length'=> 10,
            'not null'=> TRUE,
            'unsigned' => TRUE,
        ],
      'action' => [
        'description' => 'Action.',
        'type' => 'int',
        'length' => 1,
        'not null' => TRUE,
      ],
    ],
    'primary key' => ['id'],
  ];
  return $schema;
}

function hello_update_8001(){
    $schema = Database::getConnection()->schema();
    $field_spec = ['description'=> 'uid.',
                'type'=> 'int',
                 'length'=> 10,
                 'not null'=> TRUE,
                  'unsigned' => TRUE,
                ];
    $schema->addField('hello_user_statistics','uid',$field_spec);


}
function hello_uninstalled(){
   \Drupal::state()->delete('instant_calculate');
}
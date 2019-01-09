<?php

namespace Drupal\annonce\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Annonce entities.
 */
class AnnonceViewsData extends EntityViewsData
{

    /**
     * {@inheritdoc}
     */
    public function getViewsData()
    {
        $data = parent::getViewsData();

        $data = [];
        $data['annonce_history'] = [];
        $data['annonce_history']['table'] = [];
        $data['annonce_history']['table']['group'] = t('annonce_history');
        $data['annonce_history']['table']['provider'] = 'annonce';

        $data['annonce_history']['table']['base'] = [
            // Identifier (primary) field in this table for Views.
            'field' => 'id',
            'label' => 'ID_annonce_visited_history',
            'title' => t('history_annonce'),
            // Longer description in the UI. Required.
            'help' => t('Example table contains history annonce and can be related to nodes.'),
            'weight' => -10,
        ];


        $data['annonce_history']['time'] = [
            'title' => t('Time visited'),
            'label'=>t('time_visited_annonce'),
            'help' => t('Just a timestamp field.'),
            'field' => [
                // ID of field handler plugin to use.
                'id' => 'date',
            ],
            'sort' => [
                // ID of sort handler plugin to use.
                'id' => 'date',
            ],
            'filter' => [
                // ID of filter handler plugin to use.
                'id' => 'date',
            ],
        ];


        $data['annonce_history']['uid'] = [
            'field'=>['id'=> 'numeric',],
            'title' => t('annonce_auteur__visiteur'),
            'help' => t('Relate example content to the annonce history'),
            // Define a relationship to the node_field_data table, so views whose
            // base table is example_table can add a relationship to nodes. To make a
            // relationship in the other direction, you can:
            // - Use hook_views_data_alter() -- see the function body example on that
            //   hook for details.
            // - Use the implicit join method described above.
            'relationship' => [
                // Views name of the table to join to for the relationship.
                'base' => 'users_field_data',
                // Database field name in the other table to join on.
                'base field' => 'uid',
                // ID of relationship handler plugin to use.
                'id' => 'standard',
                // Default label for relationship in the UI.
                'label' => t(' auteur_visiteur_history'),
            ],
        ];

         $data['annonce_history']['aid'] = [
            'field'=>['id'=> 'numeric',],
            'title' => t('annonce_visitee'),
            'help' => t('Relate example content to the annonce history'),
            // Define a relationship to the node_field_data table, so views whose
            // base table is example_table can add a relationship to nodes. To make a
            // relationship in the other direction, you can:
            // - Use hook_views_data_alter() -- see the function body example on that
            //   hook for details.
            // - Use the implicit join method described above.
            'relationship' => [
                // Views name of the table to join to for the relationship.
                'base' => 'annonce_field_data',
                // Database field name in the other table to join on.
                'base field' => 'id',
                // ID of relationship handler plugin to use.
                'id' => 'standard',
                // Default label for relationship in the UI.
                'label' => t(' annonce_visited_history'),
            ],
        ];

        return $data;
    }
}
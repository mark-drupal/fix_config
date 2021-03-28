<?php

/* 
 * @file
 * Contains \Drupal\fix_config\Controller\MyModuleController.
 */

namespace Drupal\fix_config\Controller;

use Drupal\Core\Controller\ControllerBase;

class FirstController extends ControllerBase {
    public function fix() {
    
        ## Fixes:
        ## A non-existent config entity name returned by FieldStorageConfigInterface::getBundles(): entity type: paragraph, bundle: text, field name: field_image
        ##ater the below depending on what you have in the log files
      $entity_type = 'comment'; 
      $bundle = 'comment_node_club_review_of_a_racing_sailing_';
      $field_name = 'comment_body';

      /** @var \Drupal\Core\KeyValueStore\KeyValueFactoryInterface $key_value_factory */
      $key_value_factory = \Drupal::service('keyvalue');
      $field_map_kv_store = $key_value_factory->get('entity.definitions.bundle_field_map');
      $map = $field_map_kv_store->get($entity_type);
      // Remove the field_dates field from the bundle field map for the page bundle.
      unset($map[$field_name]['bundles'][$bundle]);
      $field_map_kv_store->set($entity_type, $map);    

        $element = array(
          '#type' => 'markup',
          '#markup' => t('Fix Config Ran')
        );

        return $element;
    }
}
<?php

namespace Drupal\sport_events_content\Controller;

use Drupal\Core\Controller\ControllerBase;
use \Mpdf\Mpdf;
use Drupal\node\Entity\Node;

class PDFController extends ControllerBase {

    public function renderNode($node_id) {
        $builder = \Drupal::entityTypeManager()->getViewBuilder('node');
        $storage = \Drupal::entityTypeManager()->getStorage('node');
        $node = $storage->load($node_id);
        $build = $builder->view($node, 'teaser');
        $output = render($build);
        $mpdf = new Mpdf(['tempDir' => 'sites/default/files/tmp']);
        $mpdf->WriteHTML($output);
        $mpdf->Output('Node.pdf', 'D');
    }
}
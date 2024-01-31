<?php
add_filter( 'gform_submit_button', function($button, $form) {
  $dom = new DOMDocument();
    $dom->loadHTML( '<?xml encoding="utf-8" ?>' . $button );
    $input = $dom->getElementsByTagName( 'input' )->item(0);
    $classes = $input->getAttribute( 'class' );
    $classes .= " btn";
    $input->setAttribute( 'class', $classes );
    return $dom->saveHtml( $input );
}, 10, 2 );
?>

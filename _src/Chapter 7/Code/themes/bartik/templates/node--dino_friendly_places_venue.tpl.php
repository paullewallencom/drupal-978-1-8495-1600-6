<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>>
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="meta submitted">
      <?php print $user_picture; ?>
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <div class="content clearfix"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
       $bodycontent =  ( ! empty( $node->body ) ) ? $node->body['und'][0]['value'] : '';
      $longitude = ( ! empty( $node->dfp_venue_longitude ) ) ? $node->dfp_venue_longitude['und'][0]['value'] : '';
      $latitude = $node->dfp_venue_latitude['und'][0]['value'];
      print "<img src='http://maps.google.com/maps/api/staticmap?center=" . $latitude . "," . $longitude . "&zoom=14&size=512x512&maptype=roadmap&markers=color:blue|label:X|" . $latitude . "," . $longitude . "&sensor=false' alt='Location' />";
	  print render( $bodycontent );
    ?>


  <?php
    // Remove the "Add new comment" link on the teaser page or if the comment
    // form is being displayed on the same page.
    if ($teaser || !empty($content['comments']['comment_form'])) {
      unset($content['links']['comment']['#links']['comment-add']);
    }
    // Only display the wrapper div if there are links.
    $links = render($content['links']);
    if ($links):
  ?>
    <div class="link-wrapper">
      <?php print $links; ?>
    </div>
  <?php endif; ?>

  <?php print render($content['comments']); ?>

</div>

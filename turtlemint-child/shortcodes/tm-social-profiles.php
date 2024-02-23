<?php
function tmSocialProfiles($atts){
    $socialProfiles = get_option( 'wpseo_social');
    $otherSocialProfiles = $socialProfiles['other_social_urls'];

    ob_start(); ?>

      <ul class="tm-social-profiles">
        <?php if ($socialProfiles['twitter_site'] ): ?>
          <li><a href="https://twitter.com/<?php echo $socialProfiles['twitter_site'] ?>"><i class="tm-sprite-3 bg-twitter" title="Twitter"></i></a></li>
        <?php endif; ?>

        <?php foreach($otherSocialProfiles as $otherSocialProfile): ?>
          <?php if(str_contains($otherSocialProfile, 'instagram')): ?>
            <li><a href="<?php echo $otherSocialProfile ?>"><i class="tm-sprite-3 bg-instagram" title="Instagram"></i></a></li>
          <?php endif; endforeach; ?>

        <?php if ($socialProfiles['facebook_site'] ): ?>
          <li><a href="<?php echo $socialProfiles['facebook_site'] ?>"><i class="tm-sprite-3 bg-facebook" title="Facebook"></i></a></li>
        <?php endif; ?>

        <?php foreach($otherSocialProfiles as $otherSocialProfile): ?>

            <?php if (str_contains($otherSocialProfile, 'linkedin')) : ?>
              <li><a href="<?php echo $otherSocialProfile ?>"><i class="tm-sprite-3 bg-linkedin-in" title="Linkedin"></i></a></li>
              <?php elseif (str_contains($otherSocialProfile, 'youtube')) : ?>
              <li><a href="<?php echo $otherSocialProfile ?>"><i class="tm-sprite-3 bg-youtube" title="Youtube"></i></a></li>
            <?php endif; ?>

        <?php endforeach; ?>
      </ul>

      <?php

      $html = ob_get_contents();

      ob_end_clean();

      return $html;
}

add_shortcode('tm_social_profiles', 'tmSocialProfiles');
?>
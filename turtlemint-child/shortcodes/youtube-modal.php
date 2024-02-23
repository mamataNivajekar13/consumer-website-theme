<?php
function youtubeVideoModal($atts) {
  $default = array(
    'link' => '',
    'thumbnail' => '',
    'alt' => '',
    'title' => ''
  );

  $tm_attrs = shortcode_atts($default, $atts);

  $link = $tm_attrs['link'];

  ob_start();
?>

  <div class="tm-video-player-thumbnail" onclick="loadVideo(this)" data-bs-toggle="modal" data-bs-target="#youtube-player-modal" data-link="<?= $tm_attrs['link']; ?>">
    <img src="<?= $tm_attrs['thumbnail']; ?>" alt="<?= $tm_attrs['alt']; ?>" title="<?= $tm_attrs['title']; ?>">
  </div>

  <script>
    function loadVideo(element) {
      const modal = document.getElementById("youtube-player-modal");
      const player = modal.querySelector("iframe");
      const videoSrc = element.getAttribute("data-link");

      player.setAttribute("src", videoSrc);
      modal.style.display = "block";
    }

    function stopVideo(element) {
      const player = document.querySelector("#youtube-player-modal iframe");
      player.setAttribute("src", "");
    }
  </script>

  <?php

    $youtubeModal = '<div class="modal tm-modal fade modal-youtube" id="youtube-player-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg border-0">
            <button type="button" id="stopVideo" onclick="stopVideo(this)" class="btn-close tm-sprite-3-before bg-xmark-light" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body" style="padding: 0px;">
                    <iframe width="100%" height="567" style="max-height: 80vh;" data-src="'.$tm_attrs['link'].'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>';
  add_action( 'wp_footer', function() use ( $youtubeModal ) {
    echo $youtubeModal;
  }, 100 );

  ?>

<?php
  return ob_get_clean();
}

add_shortcode('youtube_modal', 'youtubeVideoModal');

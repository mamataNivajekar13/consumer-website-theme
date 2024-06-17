<script type="text/javascript">
    function load_youtube_embed() {
        var youtubeContainers = document.querySelectorAll('.youtube-container');
        if(youtubeContainers){
            youtubeContainers.forEach(function (youtubeContainer) {
                var placeholder = youtubeContainer.querySelector('.youtube-placeholder');

                var observer = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        var iframe = document.createElement('iframe');
                        iframe.src = placeholder.getAttribute('data-src');
                        iframe.width = '100%';
                        iframe.height = '400';
                        iframe.frameBorder = '0';
                        iframe.allowFullscreen = true;
                        youtubeContainer.appendChild(iframe);
                        observer.disconnect();
                    }
                    });
                });

                // Start observing the placeholder
                if(placeholder){
                    observer.observe(placeholder);
                }
            });
        }
    }
    document.onreadystatechange = () => {
        if (document.readyState === "complete") {
            load_youtube_embed();
            let total_temp_styles = []
            $('style.tm-critical-temp').each(
                function(){
                   this.remove()
                }
            )
        }
    }
</script>
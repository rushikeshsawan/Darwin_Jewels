<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<div id="content">
</div> 
<?= $this->endSection() ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<script>
   $(document).ready(function() {
    $('#navbar-nav a').on('click', function(e) {
        e.preventDefault();
        var targetUrl = $(this).attr('href');

        // Load content using AJAX and inject it into the 'content' div
        $.get(targetUrl, function(data) {
            $('#content').html(data);
        });

        // Update browser history and URL without page reload
        history.pushState(null, '', targetUrl);
    });

    // Handle back/forward browser navigation
    $(window).on('popstate', function() {
        var currentUrl = window.location.pathname;
        $.get(currentUrl, function(data) {
            $('#content').html(data);
        });
    });
});

</script>
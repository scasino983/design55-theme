<footer class="site-footer">
    <p>&copy; <?php echo esc_html( date('Y') ); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'design55'); ?></p>
    <p><span class="footer-signature-text"><?php esc_html_e('Casinos Custom', 'design55'); ?></span></p>
    <div class="footer-floral">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/svg/floral-1.svg" alt="Floral Design" />
    </div>
  </footer>
  <?php wp_footer(); ?>
  <script>
jQuery(document).ready(function($) {
    var $secondaryMenu = $('.secondary-sticky-nav');
    var $siteHeader = $('.site-header');

    // Ensure menu is hidden and transparent initially
    $secondaryMenu.css({
        display: 'none',
        opacity: 0
    });

    function toggleSecondaryMenu() {
        var headerBottom = $siteHeader.offset().top + $siteHeader.outerHeight();
        if ($(window).scrollTop() > headerBottom) {
            $secondaryMenu.stop(true, true)
                .css('display', 'flex')
                .animate({ opacity: 1 }, 300);
        } else {
            $secondaryMenu.stop(true, true)
                .animate({ opacity: 0 }, 300, function() {
                    $secondaryMenu.css('display', 'none');
                });
        }
    }

    $(window).on('scroll resize', toggleSecondaryMenu);

    // Ensure all submit buttons always have the 'btn' class
    $("input[type='submit']").addClass('btn');
});
</script>
</body>
</html>

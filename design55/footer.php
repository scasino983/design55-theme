<footer class="site-footer">
    <div class="footer footer-top">
        <div class="footer-block">
            <!-- <div class="footer-logo">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<a href="' . esc_url(home_url('/')) . '" rel="home" class="site-name-link">' . esc_html(get_bloginfo('name')) . '</a>';
                }
                ?>
            </div> -->
            <div class="footer-contact">
                <a href="mainto:beth@design55interior.com" class="footer-email">
                    beth@design55interior.com
                </a>
                <div class="seperator" style="height:2px; width:2px;  background-color:var(--accent-pink);"></div>
                <a href="tel:208-555-1234" class="footer-phone">
                    208-555-1234
                </a>   
            </div>
            
            <div class="footer-socials">
                <?php
                if (has_nav_menu('social-menu')) {
                    wp_nav_menu(array(
                        'theme_location' => 'social-menu',
                        'container' => false,
                        'menu_class' => 'social-menu',
                        'fallback_cb' => false,
                    ));
                }
                ?>
            </div>
        </div>
         <div class="seperator"></div>
        <div class="footer-block">
            <ul>
                <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'design55'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/about')); ?>"><?php esc_html_e('About Us', 'design55'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/pages')); ?>"><?php esc_html_e('Pages', 'design55'); ?></a></li>
            </ul>
        </div>
        <div class="seperator"></div>
        <div class="footer-block">
            <ul>
                <li><a href="<?php echo esc_url(home_url('/services')); ?>"><?php esc_html_e('Services', 'design55'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/portfolio')); ?>"><?php esc_html_e('Portfolio', 'design55'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/testimonials')); ?>"><?php esc_html_e('Testimonials', 'design55'); ?></a></li>
            </ul>
           
        </div>
    </div>
    <div class="footer footer-bottom">
        <p>&copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'design55'); ?></p>
        <p><span class="footer-signature-text"><?php esc_html_e('Casinos Custom', 'design55'); ?></span></p>
    </div>
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
    <button id="back-to-top" aria-label="Back to top" style="display:none;position:fixed;bottom:32px;right:32px;width:32px;height:32px;background:var(--accent-pink);border:none;border-radius:50%;box-shadow:0 2px 8px rgba(0,0,0,0.12);z-index:2000;cursor:pointer;opacity:0;transition:opacity 0.3s;">
        <!-- Replace the SVG below with your custom icon if desired -->
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="10" cy="10" r="10" fill="#fff" fill-opacity="0.2"/>
            <path d="M10 15V5M10 5L5 10M10 5L15 10" stroke="var(--accent-pink)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
    <script>
        jQuery(document).ready(function($) {
            var $btn = $('#back-to-top');
            $(window).on('scroll', function() {
                if ($(window).scrollTop() > 300) {
                    $btn.stop(true,true).fadeIn(300).css('opacity',1);
                } else {
                    $btn.stop(true,true).fadeOut(300).css('opacity',0);
                }
            });
            $btn.on('click', function() {
                $('html, body').animate({scrollTop: 0}, 500);
            });
        });
    </script>
</footer>
</body>
</html>

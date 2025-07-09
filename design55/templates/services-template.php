<?php
/**
 * Template Name: Services Page
 * 
 * Services page template with alternating left-right image and text layout
 */

get_header();

// Define services data - using images from the home page template parts
$services = [
    [
        'id' => 'consolidation-assistance',
        'title' => 'Consolidation Assistance',
        'image' => get_template_directory_uri() . '/assets/images/livingroom-2.jpg',
        'description' => 'Our consolidation assistance service helps streamline your design process by bringing together all the elements of your project into a cohesive vision. We work with you to organize materials, coordinate timelines, and ensure every detail aligns with your dream space.',
        'features' => [
            'Material coordination and sourcing',
            'Timeline management and scheduling',
            'Vendor communication and oversight',
            'Budget optimization and tracking'
        ]
    ],
    [
        'id' => 'project-management',
        'title' => 'Project Management',
        'image' => get_template_directory_uri() . '/assets/images/livingroom-3.jpg',
        'description' => 'From concept to completion, our project management services ensure your design project runs smoothly and efficiently. We handle all the details so you can focus on enjoying the transformation of your space.',
        'features' => [
            'Comprehensive project planning',
            'Quality control and inspections',
            'Contractor coordination',
            'Progress reporting and updates'
        ]
    ],
    [
        'id' => 'design-consultation',
        'title' => 'Design Consultation',
        'image' => get_template_directory_uri() . '/assets/images/livingroom-4.jpg',
        'description' => 'Our design consultation service provides expert guidance to help you make informed decisions about your space. Whether you need a complete redesign or just want to refresh a room, we offer personalized solutions that reflect your style and needs.',
        'features' => [
            'Personalized design assessments',
            'Color and material recommendations',
            'Space planning and optimization',
            'Style guidance and trend insights'
        ]
    ],
    [
        'id' => 'full-service-design',
        'title' => 'Full Service Design',
        'image' => get_template_directory_uri() . '/assets/images/livingroom-5.jpg',
        'description' => 'Experience the ultimate in interior design with our full-service offering. We handle every aspect of your project from initial concept through final installation, creating spaces that are both beautiful and functional.',
        'features' => [
            'Complete design development',
            'Custom furnishing and decor',
            'Professional installation services',
            'Post-completion support and care'
        ]
    ]
];
?>

<main class="services-page">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <header class="services-page-header">
                <h1 class="services-page-title"><?php the_title(); ?></h1>
                <?php if (get_the_content()) : ?>
                    <div class="services-page-description">
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>
            </header>
        <?php endwhile; ?>

        <section class="services-section">
            <?php foreach ($services as $index => $service) : 
                $isEven = ($index % 2 === 0);
                $imageClass = $isEven ? 'services-image-left' : 'services-image-right';
                $contentClass = $isEven ? 'services-content-right' : 'services-content-left';
            ?>
                <div class="service-item <?php echo $isEven ? 'service-item-left' : 'service-item-right'; ?>" data-service-id="<?php echo esc_attr($service['id']); ?>">
                    <div class="service-row">
                        <div class="service-image-container <?php echo $imageClass; ?>">
                            <div class="service-image-wrapper">
                                <img 
                                    src="<?php echo esc_url($service['image']); ?>" 
                                    alt="<?php echo esc_attr($service['title']); ?>"
                                    class="service-image"
                                    loading="lazy"
                                >
                                <div class="service-image-overlay"></div>
                            </div>
                        </div>
                        
                        <div class="service-content-container <?php echo $contentClass; ?>">
                            <div class="service-content">
                                <h2 class="service-title"><?php echo esc_html($service['title']); ?></h2>
                                <p class="service-description"><?php echo esc_html($service['description']); ?></p>
                                
                                <ul class="service-features">
                                    <?php foreach ($service['features'] as $feature) : ?>
                                        <li class="service-feature">
                                            <svg class="feature-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <?php echo esc_html($feature); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                
                                <div class="service-cta">
                                    <a href="#contact" class="service-btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
        
        <!-- Call to Action Section -->
        <section class="services-cta-section">
            <div class="services-cta-content">
                <h2 class="services-cta-title">Ready to Transform Your Space?</h2>
                <p class="services-cta-description">Let's discuss how our services can bring your vision to life. Contact us today for a personalized consultation.</p>
                <a href="#contact" class="services-cta-btn btn-primary">Get Started</a>
            </div>
        </section>
    </div>
</main>
<?php echo do_shortcode('[newsletter_signup]'); ?>
<style>
/* Services Page Styles */
.services-page {
    padding: 2rem 0;
    min-height: 100vh;
}

.services-page-header {
    text-align: center;
    margin-bottom: 4rem;
    padding: 2rem 0;
}

.services-page-title {
    font-size: 3rem;
    margin-bottom: 1.5rem;
    color: #333;
    font-weight: 700;
}

.services-page-description {
    font-size: 1.2rem;
    color: #666;
    max-width: 800px;
    margin: 0 auto;
    line-height: 1.6;
}

.services-section {
    margin-bottom: 4rem;
}

.service-item {
    margin-bottom: 6rem;
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s ease;
}

.service-item.animate {
    opacity: 1;
    transform: translateY(0);
}

.service-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    min-height: 500px;
}

/* Left-aligned service (image left, content right) */
.service-item-left .service-image-container {
    grid-column: 1;
}

.service-item-left .service-content-container {
    grid-column: 2;
}

/* Right-aligned service (image right, content left) */
.service-item-right .service-image-container {
    grid-column: 2;
}

.service-item-right .service-content-container {
    grid-column: 1;
}

.service-image-wrapper {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.service-image-wrapper:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
}

.service-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    display: block;
}

.service-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.05));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.service-image-wrapper:hover .service-image-overlay {
    opacity: 1;
}

.service-content {
    padding: 2rem;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.service-title {
    font-size: 2.2rem;
    margin-bottom: 1.5rem;
    color: #333;
    font-weight: 600;
}

.service-description {
    font-size: 1.1rem;
    color: #666;
    line-height: 1.7;
    margin-bottom: 2rem;
}

.service-features {
    list-style: none;
    padding: 0;
    margin: 0 0 2rem 0;
}

.service-feature {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    font-size: 1rem;
    color: #555;
}

.feature-icon {
    margin-right: 0.75rem;
    color: #8B7355;
    flex-shrink: 0;
}

.service-btn {
    display: inline-block;
    padding: 0.875rem 2rem;
    background: #8B7355;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid #8B7355;
}

.service-btn:hover {
    background: transparent;
    color: #8B7355;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(139, 115, 85, 0.3);
}

/* CTA Section */
.services-cta-section {
    background: linear-gradient(135deg, #8B7355, #A68B5B);
    color: white;
    text-align: center;
    padding: 4rem 2rem;
    border-radius: 12px;
    margin-top: 4rem;
}

.services-cta-title {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    font-weight: 700;
}

.services-cta-description {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    opacity: 0.9;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.services-cta-btn {
    display: inline-block;
    padding: 1rem 2.5rem;
    background: white;
    color: #8B7355;
    text-decoration: none;
    border-radius: 6px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    border: 2px solid white;
}

.services-cta-btn:hover {
    background: transparent;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(255, 255, 255, 0.3);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .service-row {
        gap: 3rem;
    }
    
    .service-content {
        padding: 1.5rem;
    }
    
    .services-page-title {
        font-size: 2.5rem;
    }
}

@media (max-width: 768px) {
    .service-row {
        grid-template-columns: 1fr;
        gap: 2rem;
        min-height: auto;
    }
    
    /* Stack vertically on mobile - image always on top */
    .service-item-left .service-image-container,
    .service-item-right .service-image-container {
        grid-column: 1;
        grid-row: 1;
    }
    
    .service-item-left .service-content-container,
    .service-item-right .service-content-container {
        grid-column: 1;
        grid-row: 2;
    }
    
    .service-image {
        height: 300px;
    }
    
    .services-page-title {
        font-size: 2rem;
    }
    
    .service-title {
        font-size: 1.8rem;
    }
    
    .services-cta-title {
        font-size: 2rem;
    }
    
    .services-cta-section {
        padding: 3rem 1.5rem;
    }
}

@media (max-width: 480px) {
    .services-page {
        padding: 1rem 0;
    }
    
    .services-page-header {
        margin-bottom: 2rem;
        padding: 1rem 0;
    }
    
    .service-content {
        padding: 1rem;
    }
    
    .service-item {
        margin-bottom: 3rem;
    }
    
    .services-page-title {
        font-size: 1.75rem;
    }
    
    .service-title {
        font-size: 1.5rem;
    }
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Animate services on scroll
    function animateServicesOnScroll() {
        $('.service-item').each(function() {
            const $this = $(this);
            const elementTop = $this.offset().top;
            const elementBottom = elementTop + $this.outerHeight();
            const viewportTop = $(window).scrollTop();
            const viewportBottom = viewportTop + $(window).height();
            
            // Check if element is in viewport
            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $this.addClass('animate');
            }
        });
    }
    
    // Run on page load
    animateServicesOnScroll();
    
    // Run on scroll
    $(window).on('scroll', function() {
        animateServicesOnScroll();
    });
    
    // Smooth scroll for CTA buttons
    $('a[href^="#"]').on('click', function(e) {
        const target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 800);
        }
    });
    
    // Add parallax effect to images on scroll
    $(window).on('scroll', function() {
        const scrolled = $(this).scrollTop();
        const rate = scrolled * -0.1;
        
        $('.service-image').each(function() {
            $(this).css('transform', 'translateY(' + rate + 'px)');
        });
    });
    
    // Enhanced hover effects
    $('.service-image-wrapper').on('mouseenter', function() {
        $(this).find('.service-image').css('transform', 'scale(1.05)');
    }).on('mouseleave', function() {
        $(this).find('.service-image').css('transform', 'scale(1)');
    });
});
</script>

<?php get_footer(); ?>


<?php
/**
 * Template Name: Video Gallery
 * 
 * Video gallery page template with hover autoplay and modal functionality
 */

get_header();

// Define your video data - No thumbnails needed, generated from video
$videos = [
    [
        'id' => 'video-bedroom-1',
        'title' => 'Bedroom Design Showcase',
        'video_url' => get_template_directory_uri() . '/assets/videos/video-bedroom-1.mp4',
        'description' => 'Elegant bedroom transformation'
    ],
    [
        'id' => 'video-kitchen-1', 
        'title' => 'Kitchen Design Project 1',
        'video_url' => get_template_directory_uri() . '/assets/videos/video-kitchen-1.mp4',
        'description' => 'Modern kitchen renovation showcase'
    ],
    [
        'id' => 'video-kitchen-2',
        'title' => 'Kitchen Design Project 2', 
        'video_url' => get_template_directory_uri() . '/assets/videos/video-kitchen-2.mp4',
        'description' => 'Contemporary kitchen design'
    ],
    [
        'id' => 'video-kitchen-3',
        'title' => 'Kitchen Design Project 3',
        'video_url' => get_template_directory_uri() . '/assets/videos/video-kitchen-3.mp4',
        'description' => 'Luxury kitchen transformation'
    ],
    [
        'id' => 'video-livingroom-1',
        'title' => 'Living Room Design Project 1',
        'video_url' => get_template_directory_uri() . '/assets/videos/video-livingroom-1.mp4', 
        'description' => 'Beautiful living room makeover'
    ],
    [
        'id' => 'video-livingroom-2',
        'title' => 'Living Room Design Project 2',
        'video_url' => get_template_directory_uri() . '/assets/videos/video-livingroom-2.mp4',
        'description' => 'Sophisticated living space design'
    ]
];
?>

<main class="video-gallery-page">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <header class="page-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
                <?php if (get_the_content()) : ?>
                    <div class="page-description">
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>
            </header>
        <?php endwhile; ?>

        <section class="video-gallery-section">
            <div class="video-gallery-grid">
                <?php foreach ($videos as $video) : ?>
                    <div class="video-gallery-item" data-video-id="<?php echo esc_attr($video['id']); ?>">
                        <div class="video-preview-container">
                            <!-- Canvas for generated thumbnail -->
                            <canvas 
                                class="video-thumbnail-canvas" 
                                style="display: block;"
                            ></canvas>
                            
                            <!-- Loading placeholder -->
                            <div class="video-loading-placeholder">
                                <div class="loading-spinner"></div>
                                <p>Loading video...</p>
                            </div>
                            
                            <!-- Hidden video element for thumbnail generation and hover preview -->
                            <video 
                                class="video-preview" 
                                muted 
                                loop
                                preload="metadata"
                                crossorigin="anonymous"
                                data-src="<?php echo esc_url($video['video_url']); ?>"
                            >
                                <source src="<?php echo esc_url($video['video_url']); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>

                            <!-- Play button overlay -->
                            <div class="video-play-overlay">
                                <button class="video-play-btn" aria-label="Play <?php echo esc_attr($video['title']); ?>">
                                    <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="30" cy="30" r="30" fill="rgba(255, 255, 255, 0.9)"/>
                                        <path d="M24 20L24 40L40 30L24 20Z" fill="#333"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</main>
<?php echo do_shortcode('[newsletter_signup]'); ?>
<!-- Video Modal -->
<div id="video-modal" class="video-modal" style="display: none;">
    <div class="video-modal-overlay"></div>
    <div class="video-modal-container">
        <button class="video-modal-close" aria-label="Close video">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 6L6 18M6 6L18 18" stroke="white" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
        
        <div class="video-modal-content">
            <video 
                id="modal-video" 
                controls 
                preload="metadata"
                controlsList="nodownload"
            >
                <source id="modal-video-source" src="" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</div>

<style>
/* Video Gallery Styles */
.video-gallery-page {
    padding: 2rem 0;
    min-height: 100vh;
}

.page-header {
    text-align: center;
    margin-bottom: 3rem;
}

.page-title {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    color: #333;
}

.page-description {
    font-size: 1.1rem;
    color: #666;
    max-width: 600px;
    margin: 0 auto;
}

.video-gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.video-gallery-item {
    position: relative;
    aspect-ratio: 16/9;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.video-gallery-item:hover {
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.25);
}

.video-preview-container {
    position: relative;
    width: 100%;
    height: 100%;
    background: #000;
}

.video-thumbnail-canvas,
.video-preview {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.video-thumbnail-canvas {
    z-index: 1;
    transition: opacity 0.3s ease;
}

.video-loading-placeholder {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: #f0f0f0;
    z-index: 0;
}

.loading-spinner {
    width: 40px;
    height: 40px;
    border: 4px solid #e0e0e0;
    border-top: 4px solid #333;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-bottom: 1rem;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.video-loading-placeholder p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
}

.video-preview {
    z-index: 2;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.video-gallery-item:hover .video-preview {
    opacity: 1;
}

.video-gallery-item:hover .video-thumbnail-canvas {
    opacity: 0;
}

.video-play-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 3;
    background: rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease;
}

.video-gallery-item:hover .video-play-overlay {
    background: rgba(0, 0, 0, 0.3);
}

.video-play-btn {
    background: none;
    border: none;
    cursor: pointer;
    transition: transform 0.3s ease, opacity 0.3s ease;
    opacity: 0.8;
}

.video-play-btn:hover {
    transform: scale(1.1);
    opacity: 1;
}

/* Video Modal Styles */
.video-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.video-modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    cursor: pointer;
}

.video-modal-container {
    position: relative;
    width: 90vw;
    height: 90vh;
    max-width: 1200px;
    z-index: 10000;
}

.video-modal-close {
    position: absolute;
    top: -50px;
    right: 0;
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    padding: 10px;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.5);
    transition: background 0.3s ease;
    z-index: 10001;
}

.video-modal-close:hover {
    background: rgba(0, 0, 0, 0.8);
}

.video-modal-content {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

#modal-video {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    background: #000;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .video-gallery-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
}

@media (max-width: 768px) {
    .video-gallery-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .video-modal-container {
        width: 95vw;
        height: 80vh;
    }
    
    .video-modal-close {
        top: -40px;
        right: -10px;
    }
}

@media (max-width: 480px) {
    .video-gallery-page {
        padding: 1rem 0;
    }
    
    .video-gallery-grid {
        gap: 1rem;
    }
    
    .video-modal-container {
        width: 98vw;
        height: 75vh;
    }
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const galleryItems = $('.video-gallery-item');
    const modal = $('#video-modal');
    const modalVideo = $('#modal-video');
    const modalVideoSource = $('#modal-video-source');
    const modalClose = $('.video-modal-close');
    const modalOverlay = $('.video-modal-overlay');

    // Video data for modal
    const videoData = <?php echo json_encode($videos); ?>;

    // Function to generate thumbnail from video
    function generateThumbnail(videoElement, canvasElement) {
        return new Promise((resolve, reject) => {
            const video = $(videoElement)[0];
            const canvas = $(canvasElement)[0];
            const ctx = canvas.getContext('2d');
            
            // Set canvas dimensions to match container
            const container = $(videoElement).closest('.video-preview-container');
            canvas.width = container.width();
            canvas.height = container.height();
            
            const onLoadedData = function() {
                try {
                    // Seek to 10% of video duration for a good thumbnail frame
                    video.currentTime = video.duration * 0.1;
                } catch (e) {
                    // If seeking fails, try at 1 second
                    video.currentTime = Math.min(1, video.duration);
                }
            };
            
            const onSeeked = function() {
                try {
                    // Draw video frame to canvas
                    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                    
                    // Hide loading placeholder and show canvas
                    $(videoElement).siblings('.video-loading-placeholder').hide();
                    $(canvasElement).show();
                    
                    // Clean up event listeners
                    video.removeEventListener('loadeddata', onLoadedData);
                    video.removeEventListener('seeked', onSeeked);
                    video.removeEventListener('error', onError);
                    
                    resolve();
                } catch (e) {
                    reject(e);
                }
            };
            
            const onError = function(e) {
                console.error('Error generating thumbnail:', e);
                // Hide loading placeholder and show error message
                const placeholder = $(videoElement).siblings('.video-loading-placeholder');
                placeholder.find('p').text('Could not load video');
                placeholder.find('.loading-spinner').hide();
                
                video.removeEventListener('loadeddata', onLoadedData);
                video.removeEventListener('seeked', onSeeked);
                video.removeEventListener('error', onError);
                
                reject(e);
            };
            
            // Add event listeners
            video.addEventListener('loadeddata', onLoadedData);
            video.addEventListener('seeked', onSeeked);
            video.addEventListener('error', onError);
            
            // Start loading video
            video.load();
        });
    }

    // Generate thumbnails for all videos
    galleryItems.each(function() {
        const $item = $(this);
        const videoElement = $item.find('.video-preview')[0];
        const canvasElement = $item.find('.video-thumbnail-canvas')[0];
        
        // Generate thumbnail
        generateThumbnail(videoElement, canvasElement).catch(function(error) {
            console.error('Failed to generate thumbnail for video:', error);
        });
    });

    // Handle hover effects and video preview
    galleryItems.each(function() {
        const $item = $(this);
        const videoElement = $item.find('.video-preview')[0];
        
        $item.on('mouseenter', function() {
            if (videoElement.src || $(videoElement).find('source').attr('src')) {
                videoElement.currentTime = 0;
                videoElement.play().catch(e => {
                    console.log('Autoplay prevented:', e);
                });
            }
        });

        $item.on('mouseleave', function() {
            videoElement.pause();
            videoElement.currentTime = 0;
        });

        // Handle click to open modal
        $item.on('click', function() {
            const videoId = $(this).data('video-id');
            const video = videoData.find(v => v.id === videoId);
            
            if (video) {
                modalVideoSource.attr('src', video.video_url);
                modalVideo[0].load();
                modal.show().css('display', 'flex');
                $('body').css('overflow', 'hidden');
                
                // Play video after modal opens
                setTimeout(() => {
                    modalVideo[0].play().catch(e => {
                        console.log('Video play failed:', e);
                    });
                }, 100);
            }
        });
    });

    // Close modal functionality
    function closeModal() {
        modal.hide();
        modalVideo[0].pause();
        modalVideo[0].currentTime = 0;
        $('body').css('overflow', 'auto');
    }

    modalClose.on('click', closeModal);
    modalOverlay.on('click', closeModal);

    // Close modal with Escape key
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape' && modal.is(':visible')) {
            closeModal();
        }
    });

    // Prevent modal close when clicking on video
    modalVideo.on('click', function(e) {
        e.stopPropagation();
    });
});
</script>

<?php get_footer(); ?>
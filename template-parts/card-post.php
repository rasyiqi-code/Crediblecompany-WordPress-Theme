<?php
/**
 * Template Part: Card Post (Blog/Berita)
 * Mendukung gaya 'grid', 'app', dan 'featured'.
 *
 * @package CredibleCompany
 */

$style = isset( $args['style'] ) ? $args['style'] : 'grid';
$categories = get_the_category();
$cat_name = ! empty( $categories ) ? esc_html( $categories[0]->name ) : 'Berita';
?>

<?php if ( 'featured' === $style ) : ?>
    <a href="<?php the_permalink(); ?>" class="featured-post-card">
        <div class="featured-img-wrap">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'large' ); ?>
            <?php else : ?>
                <img src="https://via.placeholder.com/800x600/6366f1/ffffff?text=Featured+Article" alt="<?php the_title_attribute(); ?>">
            <?php endif; ?>
        </div>
        <div class="featured-content">
            <div class="card-meta" style="margin-bottom: 12px;">
                <span class="meta-date" style="font-weight: 600;"><?php echo get_the_date('d M Y'); ?></span>
                <span class="meta-separator">•</span>
                <span class="meta-author" style="font-weight: 600;"><?php echo get_the_author(); ?></span>
                <span class="meta-separator">•</span>
                <span class="meta-category" style="color: #3b82f6; font-weight: 700; text-transform: capitalize;"><?php echo $cat_name; ?></span>
            </div>
            <h2 class="feat-title"><?php the_title(); ?></h2>
            <p class="feat-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 25, '...' ); ?></p>
        </div>
    </a>

<?php elseif ( 'grid' === $style ) : ?>
    <a href="<?php the_permalink(); ?>" class="blog-card">
        <div class="blog-card-img">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'medium', array( 'alt' => get_the_title() ) ); ?>
            <?php else : ?>
                <img src="https://via.placeholder.com/600x400/eaeced/9ca3af?text=No+Image" alt="<?php the_title_attribute(); ?>">
            <?php endif; ?>
            
            <span class="blog-category-label"><?php echo $cat_name; ?></span>
        </div>

        <div class="blog-card-body">
            <h3><?php the_title(); ?></h3>
            <div class="card-meta" style="margin-top: 10px;">
                <span class="meta-date"><?php echo get_the_date('d M Y'); ?></span>
                <span class="meta-separator">•</span>
                <span class="meta-author"><?php echo get_the_author(); ?></span>
            </div>
        </div>
    </a>

<?php else : // app style (default grid) ?>
    <article class="app-post-card">
        <a href="<?php echo esc_url( get_permalink() ); ?>" class="card-link-overlay"></a>
        <div class="card-image-wrap">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'medium', ['class' => 'card-img'] ); ?>
            <?php else : ?>
                <div class="card-img-placeholder">📝</div>
            <?php endif; ?>
            
            <div class="card-badge">
                <?php echo $cat_name; ?>
            </div>
        </div>
        
        <div class="card-content">
            <h2 class="card-title"><?php the_title(); ?></h2>
            <div class="card-meta">
                <span class="meta-date"><?php echo get_the_date('d M Y'); ?></span>
                <span class="meta-separator">•</span>
                <span class="meta-author"><?php echo get_the_author(); ?></span>
                <span class="meta-separator">•</span>
                <span class="meta-category"><?php echo $cat_name; ?></span>
            </div>
            <p class="card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?></p>
        </div>
    </article>
<?php endif; ?>

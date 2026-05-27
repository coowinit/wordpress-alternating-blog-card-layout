<?php
/**
 * WordPress Loop Example
 *
 * 用法：把下面结构放到主题模板中，例如 archive.php、home.php 或自定义 page template。
 * 重点：偶数项输出 is-reverse，手机端 CSS 会自动恢复为“图片在上，文字在下”。
 */
?>

<section class="blog-section" aria-labelledby="blog-list-title">
  <div class="blog-container">
    <h1 id="blog-list-title" class="sr-only"><?php single_post_title(); ?></h1>

    <?php if ( have_posts() ) : ?>
      <div class="blog-list" data-blog-list>
        <?php
        $index = 0;
        while ( have_posts() ) : the_post();
          $is_reverse = ( $index % 2 === 1 ) ? ' is-reverse' : '';
          $categories = get_the_category_list( ', ' );
        ?>
          <article <?php post_class( 'blog-card' . $is_reverse ); ?> data-blog-item>
            <a class="blog-card__media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
              <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) ); ?>
              <?php else : ?>
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/blog-illustration-media.svg' ); ?>" alt="" loading="lazy" />
              <?php endif; ?>
            </a>

            <div class="blog-card__content">
              <?php if ( $categories ) : ?>
                <p class="blog-card__meta"><?php echo wp_kses_post( $categories ); ?></p>
              <?php endif; ?>

              <h2 class="blog-card__title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h2>

              <time class="blog-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                <?php echo esc_html( get_the_date( 'F d, Y' ) ); ?>
              </time>
            </div>
          </article>
        <?php
          $index++;
        endwhile;
        ?>
      </div>

      <div class="blog-actions">
        <?php
        $next_link = get_next_posts_link( 'Load More' );
        if ( $next_link ) {
          echo str_replace( '<a ', '<a class="blog-load-more" ', $next_link ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
        ?>
      </div>
    <?php endif; ?>
  </div>
</section>

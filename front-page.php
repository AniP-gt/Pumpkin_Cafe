<?php get_header(); ?>

<main id="primary" class="site-main">
  <!-- メインヴィジュアル -->
  <video class="front-movie" src="http://localhost:8000/wp-content/uploads/2023/05/pexels-polina-kovaleva-5644957-1920x1080-25fps.mp4" autoplay loop muted></video>

  <!-- スライダー -->
  <?php echo do_shortcode('[smartslider3 slider="2"]'); ?>

  <section class="pumpkin-info">
    <div class="pumpkin-info__container">
      <img class="pumpkin-info__container-img" src="http://localhost:8000/wp-content/uploads/2023/05/cake-gdf11abc97_1920.jpg" alt="pumpkin-cafe-cake">
      <div  class="pumpkin-info__container-text">
        <h2>パンプキンカフェをご案内。</h2>
        <p>ここにテキストが入りますここにテキストが入りますここにテキストが入りますここにテキストが入ります</p>
      </div>
    </div>
  </section>

  <section class="pumpkin-information">
    <h2 class="pumpkin-information__h2">INFORMATION</h2>
    <div class="tab-wrap">
      <div class="tab-group">
        <div class="tab is-active">お知らせ</div>
        <div class="tab">商品紹介</div>
        <div class="tab">ブログ</div>
      </div>
      <div class="panel-group">
        <!-- お知らせ -->
        <div class="panel is-show">
          <?php
          $args = array(
            'post_type' => 'news',
            'posts_per_page' => 10,
            'paged' => $paged
          );
          $the_query = new WP_Query($args);
          if ($the_query->have_posts()) :
          ?>
            <article class="info-news">
              <ul class="info-news__ul">
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                  <li class="info-news__ul__li">
                    <div class="info-news__ul__li__date"><?php echo get_the_date(); ?></div>
                    <a class="info-news__ul__li__a" href="<?php the_permalink(); ?>"><?php the_title(); ?>
                      <div class="info-news__ul__li__a-content">
                        <?php
                        if (mb_strlen(strip_tags(get_the_content()), 'UTF-8') > 50) {
                          $content = mb_substr(strip_tags(get_the_content()), 0, 50, 'UTF-8');
                          echo $content . '…';
                        } else {
                          echo strip_tags(get_the_content());
                        }
                        ?>
                      </div>
                    </a>
                  </li>
                <?php endwhile; ?>
              </ul>
            </article>
            <?php wp_reset_postdata(); ?>
          <?php endif; ?>
          <a class="info_index_btn" href="<?php bloginfo('url'); ?>/news">新着情報一覧</a>
        </div>
        <!-- 商品紹介 -->
        <article class="panel">
          <div class="info-wrapper">
            <?php
            $args = array(
              'post_type' => 'product',
              'posts_per_page' => 12,
              'paged' => $paged
            );
            $the_query = new WP_Query($args);
            if ($the_query->have_posts()) :
            ?>
              <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <?php get_template_part('loop-info'); ?>
                <?php wp_reset_postdata(); ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
          <a class="info_index_btn" href="<?php bloginfo('url'); ?>/product">商品一覧</a>
        </article>
        <!-- ブログ -->
        <article class="panel">
          <div class="info-wrapper">
            <?php if (have_posts()) :; ?>
              <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('loop-info'); ?>
                <?php wp_reset_postdata(); ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
          <a class="info_index_btn" href="<?php bloginfo('url'); ?>/blog">ブログ一覧</a>
        </article>
      </div>
    </div>
  </section>

  <section>
    <article class="popular-container">
      <div class="popular-container__wrapper">
        <h2>Popular Product</h2>
        <?php echo do_shortcode("[wpp post_type='product' thumbnail_width=500 thumbnail_height=500 range='all' limit=5 stats_views=1 order_by='views']"); ?>
      </div>
      <div class="popular-container__wrapper">
        <h2>Popular Blog</h2>
        <?php echo do_shortcode("[wpp post_type='post' thumbnail_width=500 thumbnail_height=500 range='all' limit=5 stats_views=1 order_by='views']"); ?>
      </div>
    </article>
  </section>
</main>

<?php get_footer(); ?>

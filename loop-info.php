
  <article>
    <div class="box">
      <a class="box-a" href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail(); ?>
        <div class="box__inner">
          <?php
          if (!is_category()) {
            $categories = get_the_category(); // 投稿のすべてのカテゴリを含んだ配列を取得
            $cat_list = '';
            foreach ($categories as $category) {
              $cat_list .= $category->cat_name . ', '; // カテゴリ名を連結
            }
            $cat_list = rtrim($cat_list, ', '); // 最後のカンマとスペースを除く
          ?>
            <p class=""><?php echo $cat_list; ?></p>
          <?php } ?>
          <p class="box__inner-text">
            <?php
            if (mb_strlen(strip_tags(get_the_content()), 'UTF-8') > 30) {
              $content = mb_substr(strip_tags(get_the_content()), 0, 30, 'UTF-8');
              echo $content . '…';
            } else {
              echo strip_tags(get_the_content());
            }
            ?>
          </p>
          <p class="box__inner-age"><?php the_time('Y.m.d'); ?></p>
        </div>
      </a>
    </div>
  </article>

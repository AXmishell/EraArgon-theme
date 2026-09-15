<?php
/**
 * 展示文章的 meta：日期、作者、分类等
 *
 */
?>
<div class="post-meta">
    <?php
        $metaList = explode('|', get_option('argon_article_meta', 'time|views|comments|categories'));
        if (is_sticky() && is_home() && ! is_paged()){
            array_unshift($metaList, "sticky");
        }
        if (post_password_required()){
            array_unshift($metaList, "needpassword");
        }
        if (argon_is_meta_simple()){
            argon_array_remove($metaList, "time");
            argon_array_remove($metaList, "edittime");
            argon_array_remove($metaList, "categories");
            argon_array_remove($metaList, "author");
        }
        if (count(get_the_category()) == 0){
            argon_array_remove($metaList, "categories");
        }
        for ($i = 0; $i < count($metaList); $i++){
            if ($i > 0){
                echo ' <div class="post-meta-devide">|</div> ';
            }
            echo argon_get_article_meta($metaList[$i]);
        }
    ?>
    <?php if (!post_password_required() && get_option("argon_show_readingtime") != "false" && argon_is_readingtime_meta_hidden() == False) {
        echo argon_get_article_reading_time_meta(get_the_content());
    } ?>
</div>

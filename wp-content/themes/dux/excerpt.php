<?php
/**
 * Used for index/archive/search/author/catgory/tag.
 *
 */
$ii = 0;
$p_meta = _hui('post_plugin');
while ( have_posts() ) : the_post(); 

    $ii++;
    echo '<article class="excerpt excerpt-'.$ii.(_hui('list_type')=='text'?' excerpt-text':'').'">';
        if( _hui('list_type')!=='text' ){
            echo '<a'._post_target_blank().' class="focus" href="'.get_permalink().'">'._get_post_thumbnail().'</a>';
        }
        echo '<header>';
            if( $p_meta && $p_meta['cat'] && !is_category() ) {
                $category = get_the_category();
                if($category[0]){
                    echo '<a class="cat" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'<i></i></a> ';
                }
            };
            echo '<h2><a'._post_target_blank().' href="'.get_permalink().'" title="'.get_the_title()._get_delimiter().get_bloginfo('name').'">'.get_the_title().'</a></h2>';
        echo '</header>';
        echo '<p class="meta">';

        if( $p_meta && $p_meta['date'] ){
            echo '<time><i class="fa fa-clock-o"></i>'.get_the_time('Y-m-d').'</time>';
        }

        if( $p_meta && $p_meta['author'] ){
            $author = get_the_author();
            if( _hui('author_link') ){
                $author = '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.$author.'</a>';
            }
            echo '<span class="author"><i class="fa fa-user"></i>'.$author.'</span>';
        }

        if( $p_meta && $p_meta['view'] ){
            echo '<span class="pv"><i class="fa fa-eye"></i>'._get_post_views().'</span>';
        }

        if ( comments_open() && $p_meta && $p_meta['comm'] ) {
            echo '<a class="pc" href="'.get_comments_link().'"><i class="fa fa-comments-o"></i>评论('.get_comments_number('0', '1', '%').')</a>';
        }


        echo '</p>';
        echo '<p class="note">'._get_excerpt().'</p>';
        if( _hui('post_link_excerpt_s') ) _moloader('mo_post_link');
    echo '</article>';

endwhile; 

_moloader('mo_paging');

wp_reset_query();
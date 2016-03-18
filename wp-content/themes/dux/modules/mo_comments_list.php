<?php
/**
 * [mo_comments_list description]
 * @param  [type] $comment [description]
 * @param  [type] $args    [description]
 * @param  [type] $depth   [description]
 * @return [type]          [description]
 */
function mo_comments_list($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
    global $commentcount,$wpdb, $post;
    if(!$commentcount) { //初始化楼层计数器
    $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_type = '' AND comment_approved = '1' AND !comment_parent");
    $cnt = count($comments);//获取主评论总数量
    $page = get_query_var('cpage');//获取当前评论列表页码
    $cpp=get_option('comments_per_page');//获取每页评论显示数量
    if (ceil($cnt / $cpp) == 1 || ($page > 1 && $page  == ceil($cnt / $cpp))) {
      $commentcount = $cnt + 1;//如果评论只有1页或者是最后一页，初始值为主评论总数
    } else {
      $commentcount = $cpp * $page + 1;
    }
    }


  echo '<li '; comment_class(); echo ' id="comment-'.get_comment_ID().'">';

  //楼层
    if(!$parent_id = $comment->comment_parent) {
        echo '<span class="comt-f">'; printf('#%1$s', --$commentcount); echo '</span>';
    }


  //头像
  echo '<div class="comt-avatar">';
  echo _get_the_avatar($user_id=$comment->user_id, $user_email=$comment->comment_author_email);
  echo '</div>';
  //内容
  echo '<div class="comt-main" id="div-comment-'.get_comment_ID().'">';
    // echo str_replace(' src=', ' data-src=', convert_smilies(get_comment_text()));
    comment_text();
    if ($comment->comment_approved == '0'){
      echo '<span class="comt-approved">待审核</span>';
    }
    echo '<div class="comt-meta"><span class="comt-author">'.get_comment_author_link().'</span>';
    echo _get_time_ago($comment->comment_date); 
    if ($comment->comment_approved !== '0'){
        $replyText = get_comment_reply_link( array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
        // echo str_replace(' href', ' href="javascript:;" data-href', $replyText ); 
        if( strstr($replyText, 'reply-login') ){
          echo preg_replace('# class="[\s\S]*?" href="[\s\S]*?"#', ' class="signin-loader" href="javascript:;"', $replyText );
        }else{
          echo preg_replace('# href=[\s\S]*? onclick=#', ' href="javascript:;" onclick=', $replyText );
        }
    }
    echo '</div>';
  echo '</div>';
}
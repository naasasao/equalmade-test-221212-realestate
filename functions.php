<?php

function my_setup() {
	add_theme_support( 'post-thumbnails' ); /* アイキャッチ */
	add_theme_support( 'automatic-feed-links' ); /* RSSフィード */
	add_theme_support( 'title-tag' ); /* タイトルタグ自動生成 */
	add_theme_support(
		'html5',
		array( /* HTML5のタグで出力 */
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);
}
add_action( 'after_setup_theme', 'my_setup' );

/**
 * CSSとJavaScriptの読み込み
 *
 * @codex https://wpdocs.osdn.jp/%E3%83%8A%E3%83%93%E3%82%B2%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3%E3%83%A1%E3%83%8B%E3%83%A5%E3%83%BC
 */
function my_script_init()
{

	wp_enqueue_style( 'my', get_template_directory_uri() . '/css/styles.css');
	
	wp_enqueue_script( 'myjquery', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0.1', true );
		
}
add_action('wp_enqueue_scripts', 'my_script_init');


function es_googlemapsapi() {
    if(is_page('company')) {
        wp_enqueue_script('googlemapsapi', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyA-jqq_AEiMaA76UVZBRK37He0IAdBPPU4&callback=initMap', array(), '', true);
    }
}
add_action('wp_enqueue_scripts', 'es_googlemapsapi');



/**
 * アーカイブタイトル書き換え
 *
 * @param string $title 書き換え前のタイトル.
 * @return string $title 書き換え後のタイトル.
 */
function my_archive_title( $title ) {

	if ( is_home() ) { /* ホームの場合 */
		$title = 'ニュース';
	} elseif ( is_category() ) { /* カテゴリーアーカイブの場合 */
		$title = '' . single_cat_title( '', false ) . '';
	} elseif ( is_tag() ) { /* タグアーカイブの場合 */
		$title = '' . single_tag_title( '', false ) . '';
	} elseif ( is_post_type_archive() ) { /* 投稿タイプのアーカイブの場合 */
		$title = '' . post_type_archive_title( '', false ) . '';
	} elseif ( is_tax() ) { /* タームアーカイブの場合 */
		$title = '' . single_term_title( '', false );
	} elseif ( is_search() ) { /* 検索結果アーカイブの場合 */
		$title = '「' . esc_html( get_query_var( 's' ) ) . '」の検索結果';
	} elseif ( is_author() ) { /* 作者アーカイブの場合 */
		$title = '' . get_the_author() . '';
	} elseif ( is_date() ) { /* 日付アーカイブの場合 */
		$title = '';
		if ( get_query_var( 'year' ) ) {
			$title .= get_query_var( 'year' ) . '年';
		}
		if ( get_query_var( 'monthnum' ) ) {
			$title .= get_query_var( 'monthnum' ) . '月';
		}
		if ( get_query_var( 'day' ) ) {
			$title .= get_query_var( 'day' ) . '日';
		}
	}
	return $title;
};
add_filter( 'get_the_archive_title', 'my_archive_title' );


/**
 * 抜粋文の文字数の変更
 *
 * @param int $length 変更前の文字数.
 * @return int $length 変更後の文字数.
 */
function my_excerpt_length( $length ) {
	return 80;
}
add_filter( 'excerpt_length', 'my_excerpt_length', 999 );


/**
 * 抜粋文の省略記法の変更
 *
 * @param string $more 変更前の省略記法.
 * @return string $more 変更後の省略記法.
 */
function my_excerpt_more( $more ) {
	return '...';

}
add_filter( 'excerpt_more', 'my_excerpt_more' );


//画像の自動生成を止める
function remove_image_sizes( $sizes ) {
//   unset( $sizes['thumbnail'] );
  unset( $sizes['medium'] );
  unset( $sizes['large'] );
  unset( $sizes['1536x1536'] );
  unset( $sizes['2048x2048'] );
  return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'remove_image_sizes' );
add_filter( 'big_image_size_threshold', '__return_false' );
update_option( 'medium_large_size_w', 0 );




// パンくずリスト
function breadcrumb() {
    // $home = '<li><a href="'.get_bloginfo('url').'" >HOME　→</a></li>';
    $home = '<li><a href="'.home_url('/').'" >HOME　→</a></li>';
    $news = '<li><a href="'.home_url('/news/').'" >ニュース　→</a></li>';
 
    echo '<ul class="mv-sub__breadcrumb breadcrumb layout-breadcrumb">';
    if ( is_front_page() ) {
        // トップページの場合
    }
    else if (is_home()){
    echo $home;
    echo $news;

    }
    else if ( is_category() ) {
        // カテゴリページの場合
        $cat = get_queried_object();
        $cat_id = $cat->parent;
        $cat_list = array();
        while ($cat_id != 0){
            $cat = get_category( $cat_id );
            $cat_link = get_category_link( $cat_id );
            array_unshift( $cat_list, '<li><a href="'.$cat_link.'">'.$cat->name.'</a></li>' );
            $cat_id = $cat->parent;
        }
        echo $home;
        echo $news;

        foreach($cat_list as $value){
            echo $value;
        }
        the_archive_title('<li>', '</li>');
    }
    else if ( is_archive() ) {
    // 月別アーカイブ・タグページの場合
    echo $home;
    echo $news;
    the_archive_title('<li>', '</li>');
    }
    else if ( is_single() ) {
    // 投稿ページの場合
    echo $home;
    echo $news;

    $cat = get_the_category();
        if( isset($cat[0]->cat_ID) ) $cat_id = $cat[0]->cat_ID;
        $cat_list = array();
        while ($cat_id != 0){
            $cat = get_category( $cat_id );
            $cat_link = get_category_link( $cat_id );
            array_unshift( $cat_list, '<li><a href="'.$cat_link.'">'.$cat->name.'　'.'</a></li>' );
            $cat_id = $cat->parent;
        }
        foreach($cat_list as $value){
            echo $value;
        }
        // the_title('<li>', '</li>');
    }
    else if( is_page() ) {
    // 固定ページの場合
    echo $home;
	the_title('<li class="breadcrumb__item">', '</li>');
    }
    else if( is_search() ) {
    // 検索ページの場合
    echo $home;
    echo '<li>「'.get_search_query().'」の検索結果</li>';
    }
    else if( is_404() ) {
    // 404ページの場合
    echo $home;
    echo '<li>ページが見つかりません</li>';
    }
    echo "</ul>";
}
 
// アーカイブの余計なタイトルを削除
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_month() ) {
        $title = single_month_title( '', false );
    }
    return $title;
});


//wp_get_archiveへのクラス追加
function my_archives_link($link_html){
    $link_html = preg_replace('@<li>@i', '<li class="sidebar__category">', $link_html);
    return $link_html;
    }
add_filter('get_archives_link', 'my_archives_link');



?>
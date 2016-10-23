<?php

//カスタムメニュー
add_theme_support( 'menus' );


// カスタム投稿タイプ・カスタム分類
add_action('init', 'register_post_type_and_taxonomy');
function register_post_type_and_taxonomy() {
  // カスタム投稿タイプ product
  register_post_type(
    'product',
    array(
      'labels' => array(
        'name' => '商品投稿',
        'add_new_item' => '商品を追加',
        'edit_item' => '商品の編集',
      ),
      'public' => true,
      'hierarchical' => true,
      'supports' => array(
        'title',
        'editor',
        'excerpt',
        'custom-fields',
        'thumbnail',
      ),
    )
  );

   // カスタム分類 product->product_category
  register_taxonomy(
    'product_category',
    'product',
    array(
      'labels' => array(
        'name' => '商品カテゴリー',
        'add_new_item' => '商品カテゴリーを追加',
        'edit_item' => '商品カテゴリーの編集',
      ),
      'hierarchical' => true,
      'show_admin_column' => true,
    )
  );

  // カスタム分類 product->maker
  register_taxonomy(
    'maker',
    'product',
    array(
      'labels' => array(
        'name' => 'メーカー',
        'add_new_item' => 'メーカーを追加',
        'edit_item' => 'メーカーの編集',
      ),
      'hierarchical' => true,
      'show_admin_column' => true,
    )
  );

  // カスタム分類 商品投稿用タグ product->product_tag
  register_taxonomy(
    'product_tag',
    'product',
    array(
      'labels' => array(
        'name' => '商品投稿用タグ',
        'add_new_item' => '商品投稿用タグを追加',
        'edit_item' => '商品投稿用タグの編集',
      ),
      'hierarchical' => true,
      'show_admin_column' => true,
    )
  );

  // カスタム投稿タイプ information_post
  register_post_type(
    'information_post',
    array(
      'labels' => array(
        'name' => 'お知らせ一覧',
        'add_new_item' => 'お知らせを追加',
        'edit_item' => 'お知らせの編集',
      ),
      'public' => true,
      'hierarchical' => true,
      'has_archive' => true,
      'supports' => array(
        'title',
        'editor',
        'excerpt',
        'custom-fields',
        'thumbnail',
      ),
    )
  );

   // カスタム分類 product->product_category
  register_taxonomy(
    'information_category',
    'information_post',
    array(
      'labels' => array(
        'name' => 'お知らせカテゴリー',
        'add_new_item' => 'お知らせカテゴリーを追加',
        'edit_item' => 'お知らせカテゴリーの編集',
      ),
      'hierarchical' => true,
      'show_admin_column' => true,
    )
  );

}




//検索ワードが0または未入力の場合にsearch.phpをテンプレートとして利用する
function apt_search_redirect(){
  global $wp_query;
  $wp_query->is_search = true;
  $wp_query->is_home = false;

  if(file_exists(TEMPLATEPATH . '/search.php')){
    include(TEMPLATEPATH . '/search.php');
  }
  exit;
}

if(isset($_GET['s']) && $_GET['s'] == false ){
  add_action('template_redirect', 'apt_search_redirect');
}


//検索結果を商品投稿のみにする(ポストタイプproductのタイトルと本文のみ)
function SearchFilter($query) {
 if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
  $query->set( 'post_type', 'product' );
 }
}

add_action( 'pre_get_posts','SearchFilter' );



// // 検索の対象範囲を拡大する
// function custom_search($search, $wp_query) {
//     global $wpdb;
  
//     //サーチページ以外だったら終了
//     if (!$wp_query->is_search)
//         return $search;
//     if (!isset($wp_query->query_vars))
//         return $search;
  
//     // ユーザー名とか、タグ名・カテゴリ名も検索対象に
//     $search_words = explode(' ', isset($wp_query->query_vars['s']) ? $wp_query->query_vars['s'] : '');
//     if ( count($search_words) > 0 ) {
//         $search = '';
//         foreach ( $search_words as $word ) {
//             if ( !empty($word) ) {
//                 $search_word = esc_sql("%{$word}%");
//                 $search .= " AND (
//  {$wpdb->posts}.post_title LIKE '{$search_word}'
//  OR {$wpdb->posts}.post_content LIKE '{$search_word}'
//  OR {$wpdb->posts}.post_author IN (
//    SELECT distinct ID
//    FROM {$wpdb->users}
//    WHERE display_name LIKE '{$search_word}'
//    )
//  OR {$wpdb->posts}.ID IN (
//    SELECT distinct r.object_id
//    FROM {$wpdb->term_relationships} AS r
//    INNER JOIN {$wpdb->term_taxonomy} AS tt ON r.term_taxonomy_id = tt.term_taxonomy_id
//    INNER JOIN {$wpdb->terms} AS t ON tt.term_id = t.term_id
//    WHERE t.name LIKE '{$search_word}'
//      OR t.slug LIKE '{$search_word}'
//      OR tt.description LIKE '{$search_word}'
//    )
// ) ";
//             }
//         }
//     }
  
//     return $search;
// }
// add_filter('posts_search','custom_search', 10, 2);



// アーカイブページで現在のカテゴリー・タグ・タームを取得する
function get_current_term(){
	$id;
	$tax_slug;
	
	if(is_category()){
		$tax_slug = "category";
    $id = get_query_var('cat');
  }else if(is_tag()){
    $tax_slug = "post_tag";
		$id = get_query_var('tag_id'); 
  }else if(is_tax()){
	  $tax_slug = get_query_var('taxonomy'); 
	  $term_slug = get_query_var('term');
	  $term = get_term_by("slug",$term_slug,$tax_slug);
	  $id = $term->term_id;
  } 
	return get_term($id,$tax_slug);
}


//wp_list_categoriesのtitle属性を削除する
function delete_list_categories_title_attribute( $output ) {
  $output = preg_replace( '/ title="[^"]*"/', '', $output );
  return $output;
}
add_filter( 'wp_list_categories', 'delete_list_categories_title_attribute' );


//抜粋のデフォルト表示を変更する
function new_excerpt_more($more) {
  return '・・・';
}
add_filter('excerpt_more', 'new_excerpt_more');


//画像の圧縮率を100に変更する(PHP5.2以下の場合)
//add_filter('jpeg_quality', create_function('$arg','return 100;'));


//画像の圧縮率を100に変更する(PHP5.3以上の場合)
add_filter('jpeg_quality', function($arg){return 100;});


//管理画面のカスタム投稿タイプ一覧におすすめ商品列追加
function manage_posts_columns($columns) {
  $columns['cf_recommended'] = "おすすめ商品掲載";
  return $columns;
}
function add_column($column_name, $post_id) {
  if( $column_name == 'cf_recommended' ) {
      $stitle = get_post_meta($post_id, 'cf_recommended', true);
  }

  if ( isset($stitle) && $stitle ) {
      echo esc_attr($stitle);
  } else {
      echo __('None');
  }
}
add_filter( 'manage_edit-product_columns', 'manage_posts_columns' );
add_action( 'manage_product_posts_custom_column', 'add_column', 10, 2 );









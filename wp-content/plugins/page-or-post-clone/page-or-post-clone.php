<?php
/**
 * @package CF Page or Post Duplicator
 * @version 0.1
 */
/*
Plugin Name: CF Page or Post Duplicator
Plugin URI: #
Description: Permite a duplicação de Artigos ou Páginas
Author: Carlos Fazenda
Version: 0.1
Author URI: http://carlosfazenda.com/
*/

/*
 * Duplica o Artigo/Página como draft e redireciona para o editor do Artigo/Página duplicado
 */
function content_clone(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'content_clone' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to duplicate has been supplied!');
	}
 
	/*
	 * id do Artigo/Página original
	 */
	$post_id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
	/*
	 * conteúdo do Artigo/Página original
	 */
	$post = get_post( $post_id );
 
	/*
	 * O autor do novo Artigo/Página é o utilizador corrente
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
 
	/*
	 * se o Artigo/Página tiver conteúdo, duplica também
	 */
	if (isset( $post ) && $post != null) {
 
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
 
		/*
		 * insere o novo Artigo/Página via wp_insert_post()
		 */
		$new_post_id = wp_insert_post( $args );
 
		/*
		 * leva também as taxonomias do Artigo/Página a duplicar
		 */
		$taxonomies = get_object_taxonomies($post->post_type); // retorna um array das taxonomias
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
 
		/*
		 * SQL
		 */
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
 
 
		/*
		 * Redirect para o editor de Artigos/Páginas
		 */
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Não foi possível encontrar o Artigo/Página: ' . $post_id);
	}
}
add_action( 'admin_action_content_clone', 'content_clone' );
 
/*
 * Adiciona o botao "Duplicar" na listagem de Artigos/Páginas
 */
function content_clone_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="admin.php?action=content_clone&amp;post=' . $post->ID . '" title="Clone this!" rel="permalink">Clone</a>';
	}
	return $actions;
}
 
add_filter( 'post_row_actions', 'content_clone_link', 10, 2 ); // Para artigos
add_filter( 'page_row_actions', 'content_clone_link', 10, 2 ); //Para páginas

?>
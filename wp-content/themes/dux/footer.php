<?php  
	if( _hui('footer_brand_s') ){
		_moloader('mo_footer_brand', false);
	}
?>

<footer class="footer">
	<div class="container">
		<div class="fcode">
			<?php echo _hui('fcode') ?>
		</div>
		<p>&copy; <?php echo date('Y'); ?> <a href="<?php echo home_url() ?>"><?php echo get_bloginfo('name') ?></a> &nbsp; <?php echo _hui('footer_seo') ?></p>
		<?php echo _hui('trackcode') ?>
	</div>
</footer>

<?php  
	$roll = 0;
	if( is_home() && _hui('sideroll_index_s') ){
		$roll = _hui('sideroll_index');
	}else if( (is_category() || is_tag() || is_search()) && _hui('sideroll_list_s') ){
		$roll = _hui('sideroll_list');
	}else if( is_single() && _hui('sideroll_post_s') ){
		$roll = _hui('sideroll_post');
	}
	if( $roll ){
		$roll = json_encode(explode(' ', $roll));
	}else{
		$roll = [];
	}

	_moloader('mo_get_user_rp');
?>
<script>
window.jsui={
    www: '<?php echo home_url() ?>',
    uri: '<?php echo get_stylesheet_directory_uri() ?>',
    ver: '<?php echo THEME_VERSION ?>',
	roll: <?php echo $roll ?>,
    ajaxpager: '<?php echo _hui("ajaxpager") ?>',
    url_rp: '<?php echo mo_get_user_rp() ?>'
};
</script>
<?php wp_footer(); ?>
</body>
</html>
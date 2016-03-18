<?php  
	$pagemenus = _hui('page_menu');
	$menus = '';
	if( $pagemenus ){
		foreach ($pagemenus as $key => $value) {
			if( $value ) $menus .= '<li><a href="'.get_permalink($key).'">'.get_post($key)->post_title.'</a></li>';
		}
	}

?>
<div class="pageside">
	<div class="pagemenus">
		<ul class="pagemenu">
			<?php echo $menus ?>
		</ul>
	</div>
</div>
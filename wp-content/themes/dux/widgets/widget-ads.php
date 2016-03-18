<?php

class widget_ui_ads extends WP_Widget {
	function widget_ui_ads() {
		$widget_ops = array( 'classname' => 'widget_ui_ads', 'description' => '显示一个广告(包括富媒体)' );
		$this->WP_Widget( 'widget_ui_ads', 'D-广告', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$code = $instance['code'];

		echo $before_widget;
		echo '<div class="item">'.$code.'</div>';
		echo $after_widget;
	}

	function form($instance) {
		$defaults = array( 
			'title' => '广告',
			'code' => '<a href="http://www.daqianduan.com/theme/xiu"><img src="http://www.daqianduan.com/wp-content/uploads/2015/01/asb-01.jpg"></a>'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
		<p>
			<label>
				广告名称：
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				广告代码：
				<textarea id="<?php echo $this->get_field_id('code'); ?>" name="<?php echo $this->get_field_name('code'); ?>" class="widefat" rows="12" style="font-family:Courier New;"><?php echo $instance['code']; ?></textarea>
			</label>
		</p>
<?php
	}
}
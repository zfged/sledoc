<link rel="stylesheet" property='stylesheet' type="text/css" href="catalog/view/javascript/jquery/coin_slider/coin-slider-styles.css" media="screen"/>
<script type="text/javascript" src="catalog/view/javascript/jquery/coin_slider/coin-slider.min.js"></script> 

<?php if ($slider_config['status'] == 1) { ?>
	<div id="coin-slider<?php echo $module; ?>">
	  <?php foreach ($sliders as $slider) { ?>
		  <?php if ($slider['link']) { ?>
		  	<a href="<?php echo $slider['link']; ?>" <?php if ($slider_config['link_new_tab'] == 0) { ?> target="_blank" <?php } ?> >
				<img src="<?php echo $slider['image']; ?>" alt="slider">
				<span>
					<span class="title"><?php echo $slider['title']; ?></span>
					<span class="subtitle">
						<?php echo $slider['subtitle']; ?>
					</span>
				</span>
			</a>
		  <?php } else { ?>
		  	<img src="<?php echo $slider['image']; ?>" alt="slider">
			<span>
				<span class="title"><?php echo $slider['title']; ?></span>
				<span class="subtitle">
					<?php echo $slider['subtitle']; ?>
				</span>
			</span>
		  <?php } ?>
	  <?php } ?>
	</div>

	<script type="text/javascript"><!--
		$(document).ready(function() {
			$('#coin-slider<?php echo $module; ?>').coinslider({ 
				width: <?php echo $sliders[0]['width'] ?>,
				height: <?php echo $sliders[0]['height'] ?>,
				spw: <?php echo $slider_config['spw'] ?>,
				sph: <?php echo $slider_config['sph'] ?>,
				delay: <?php echo $slider_config['delay'] ?>,
				sDelay: <?php echo $slider_config['s_delay'] ?>,
				opacity: <?php echo $slider_config['opacity'] ?>,
				titleSpeed: <?php echo $slider_config['title_speed'] ?>,
				effect: '<?php echo $slider_config['effect'] ?>',
				navigation: <?php echo $slider_config['navigation'] ?>,
				links: <?php echo $slider_config['links'] ?>,
				hoverPause: <?php echo $slider_config['hover_pause'] ?>,
			});
			$(".cs-prev").text('<?php echo $text_prev; ?>');
			$(".cs-next").text('<?php echo $text_next; ?>');
		});
	//--></script>
<?php } ?>



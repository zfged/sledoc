<style type="text/css">

</style>
<div class="box">
	<div class="box-heading"><?php echo $heading_title; ?></div>
	<div class="box-content">
		<div class="box-product">
			<?php foreach($categories as $category) { ?>
			<div>
				<div class="image">
					<?php if($category['thumb']) { ?>
					<a href="<?php echo $category['href']; ?>"><img src="<?php echo $category['thumb']; ?>" alt="<?php echo $category['name']; ?>"/></a>
					<?php } ?>
				</div>
				<a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
			</div>
			<?php } ?>
		</div>
	</div>
</div>

<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
<?php
if ($_SERVER["REQUEST_URI"] !== '/'){
	?><h1 style="display: none;"><?php echo $heading_title; ?></h1><?php
}
?>
<?php echo $content_bottom; ?></div>
<?php echo $footer; ?>
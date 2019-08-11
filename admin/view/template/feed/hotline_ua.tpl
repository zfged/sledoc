<?php echo $header; ?>
<div id="content">
	<div class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
		<?php } ?>
	</div>
	<?php if ($error_warning) { ?>
	<div class="warning"><?php echo $error_warning; ?></div>
	<?php } ?>
	<div class="box">
		<div class="heading">
			<h1><img src="view/image/feed.png" alt="" /> <?php echo $heading_title; ?></h1>
			<div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
		</div>

		<div class="content">
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
			<table class="form">
				<tr>
				<td><?php echo $entry_status; ?></td>
				<td><select name="hotline_ua_status">
					<?php if ($hotline_ua_status) { ?>
					<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
					<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
					<option value="1"><?php echo $text_enabled; ?></option>
					<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
					<?php } ?>
					</select></td>
				</tr>
				<tr>
				<td><?php echo $entry_shopname; ?></td>
				<td><input name="hotline_ua_shopname" type="text" value="<?php echo $hotline_ua_shopname; ?>" size="40" maxlength="20" /></td>
				</tr>
				<tr>
				<td><?php echo $entry_company; ?></td>
				<td><input name="hotline_ua_company" type="text" value="<?php echo $hotline_ua_company; ?>" size="40" /></td>
				</tr>
				<tr>
				<td><?php echo $entry_category; ?></td>
				<td><div class="scrollbox">
					<?php $class = 'odd'; ?>
					<?php foreach ($categories as $category) { ?>
					<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
					<div class="<?php echo $class; ?>">
						<?php if (in_array($category['category_id'], $hotline_ua_categories)) { ?>
						<input type="checkbox" name="hotline_ua_categories[]" value="<?php echo $category['category_id']; ?>" checked="checked" />
						<?php echo $category['name']; ?>
						<?php } else { ?>
						<input type="checkbox" name="hotline_ua_categories[]" value="<?php echo $category['category_id']; ?>" />
						<?php echo $category['name']; ?>
						<?php } ?>
					</div>
					<?php } ?>
                </div>
                <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a></td>
				</tr>
				<tr>
				<td><?php echo $entry_currency; ?></td>
				<td><select name="hotline_ua_currency">
					<?php foreach ($currencies as $currency) { ?>
					<?php if ($currency['code'] == $hotline_ua_currency) { ?>
					<option value="<?php echo $currency['code']; ?>" selected="selected"><?php echo '(' . $currency['code'] . ') ' . $currency['title']; ?></option>
					<?php } else { ?>
					<option value="<?php echo $currency['code']; ?>"><?php echo '(' . $currency['code'] . ') ' . $currency['title']; ?></option>
					<?php } ?>
					<?php } ?>
					</select></td>
				</tr>
                <tr>
                <td><?php echo $entry_in_stock; ?></td>
                <td><select name="hotline_ua_in_stock">
                    <?php foreach ($stock_statuses as $stock_status) { ?>
                    <?php if ($stock_status['stock_status_id'] == $hotline_ua_in_stock) { ?>
                    <option value="<?php echo $stock_status['stock_status_id']; ?>" selected="selected"><?php echo $stock_status['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $stock_status['stock_status_id']; ?>"><?php echo $stock_status['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                    </select></td>
                </tr>
                <tr>
                <td><?php echo $entry_out_of_stock; ?></td>
                <td><select name="hotline_ua_out_of_stock">
                    <?php foreach ($stock_statuses as $stock_status) { ?>
                    <?php if ($stock_status['stock_status_id'] == $hotline_ua_out_of_stock) { ?>
                    <option value="<?php echo $stock_status['stock_status_id']; ?>" selected="selected"><?php echo $stock_status['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $stock_status['stock_status_id']; ?>"><?php echo $stock_status['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                    </select></td>
                </tr>
                <tr>
                    <td><?php echo $entry_ip_list; ?></td>
                    <td><textarea rows="8" cols="80" name="hotline_ua_ip_list"><?php echo $hotline_ua_ip_list; ?></textarea></td>
                </tr>
                <tr>
                    <td><?php echo $entry_image_width; ?></td>
                    <td><input name="hotline_ua_image_width" type="text" value="<?php echo $hotline_ua_image_width; ?>" size="40" maxlength="20" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_image_height; ?></td>
                    <td><input name="hotline_ua_image_height" type="text" value="<?php echo $hotline_ua_image_height; ?>" size="40" maxlength="20" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_warranty; ?></td>
                    <td><input name="hotline_ua_warranty" type="text" value="<?php echo $hotline_ua_warranty; ?>" size="40" maxlength="20" /></td>
                </tr>
				<tr>
				    <td><?php echo $entry_data_feed; ?></td>
				    <td><i><?php echo $data_feed; ?></i></td>
				</tr>
			</table>
			</form>
		</div>
	</div>
</div>
<?php echo $footer; ?>
<div class="box">
  <div class="box-heading"><?php if ($testimonial_title=="") echo "<br>"; else echo $testimonial_title; ?></div>
  <div class="box-content">
    <div class="box-product">

    <table style="width: 100%; padding: 2px; border-spacing: 0px;">
      <?php foreach ($testimonials as $testimonial) { ?>
      <tr><td>

          <div class="name"><b><?php echo $testimonial['title']; ?></b></div>

          <div class="description"><?php echo $testimonial['description'] ; ?></div><br>

          <div style="width:100%; text-align:right; margin-bottom:12px; padding-bottom:4px;border-bottom:dotted silver 1px;">


                <?php if ($testimonial['rating']) { ?>
                  <img src="catalog/view/theme/default/image/testimonials/stars-<?php echo $testimonial['rating'] . '.png'; ?>" style="margin-top: 2px;" alt="ratingstar"/>
                <?php } ?>


		<?php if ($testimonial['name']!="") echo '<br>'.$testimonial['name']; else echo $testimonial['name']; ?>
		<?php echo $testimonial['city']; ?>

<br><br>

		</div>

       </td>
      </tr>

      <?php } ?>

<tr><td>

	<div class="name" style="text-align:right"><a href="<?php echo $showall_url;?>"><?php echo $show_all; ?></a></div>
	<div class="name" style="text-align:right"><a href="<?php echo $isitesti; ?>"><?php echo $isi_testimonial; ?></a></div>

</td></tr>
    </table>

	

    </div>
  </div>
</div>


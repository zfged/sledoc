<div style="clear:both"></div>
<script type="text/javascript"><!--
  $(".pagination a:contains('\>\|')").text("▶▶");
  $(".pagination a:contains('\|\<')").text("◀◀");
  $(".pagination a:contains('\>')").text("▶");
  $(".pagination a:contains('\<')").text("◀");
//--></script>
</div>
<div class="footer-wrap">
<div id="footer">
  <?php if ($informations) { ?>
  <div class="column">
    <h3><?php echo $text_information; ?></h3>
    <ul>
      <?php foreach ($informations as $information) { ?>
      <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
      <?php } ?>
    </ul>
  </div>
  <?php } ?>
  <div class="column">
    <h3><?php echo $text_service; ?></h3>
    <ul>
      <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
      <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
    </ul>
  </div>
  <div class="column">
    <h3><?php echo $text_extra; ?></h3>
    <ul>
      <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
      <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
    </ul>
  </div>
  <div class="column">
    <h3><?php echo $text_account; ?></h3>
    <ul>
      <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
      <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
    </ul>
  </div>
</div>

<div class="powered-wrap">

	<div id="powered">
	<div itemscope itemtype="http://schema.org/LocalBusiness">
		<p itemprop=name>Интернет-магазин систем безопасности "Следок"</p>                        
		<span itemprop="location" itemscope itemtype="http://schema.org/Place">
		<span itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
		<meta itemprop="latitude" content="50.4933131" />
		<meta itemprop="longitude" content="30.4665041" />
		<p itemprop=address itemscope itemtype="http://schema.org/PostalAddress">
		<span itemprop=streetAddress>ул. Скляренко, 5, офис 409а.</span>
		<span itemprop=addressLocality>г. Киев</span>
		<span itemprop=addressRegion>Киевская обл.</span>
		<span itemprop=postalCode>04073</span>
		<span style="padding-bottom:2px!important" itemprop=telephone>тел:(044) 227-20-67</span>        
		</span>
		</span>
	</div>
	</div>
</div>
</div>

<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'YgZqB2HF4g';
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
<!-- {/literal} END JIVOSITE CODE -->

<script type="text/javascript" charset="utf-8" src="/callme/js/callme.js"></script>
</body></html>
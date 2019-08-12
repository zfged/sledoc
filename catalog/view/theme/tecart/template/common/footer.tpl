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
    <div class="kak-h3"><?php echo $text_information; ?></div>
    <ul>
      <?php foreach ($informations as $information) { ?>
      <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
      <?php } ?>
    </ul>
  </div>
  <?php } ?>
  <div class="column">
    <div class="kak-h3"><?php echo $text_service; ?></div>
    <ul>
      <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
      <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
    </ul>
  </div>
  <div class="column">
    <div class="kak-h3"><?php echo $text_extra; ?></div>
    <ul>
      <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
      <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
    </ul>
  </div>
  <div class="column">
    <div class="kak-h3"><?php echo $text_account; ?></div>
    <ul>
      <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
      <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
    </ul>
  </div>
</div>

<div class="powered-wrap">

	<div id="powered">
	<div xmlns:v="http://rdf.data-vocabulary.org/#">

<div class="breadcrumb" style="background: #30363b url(../image/footer-bg.png) 0 0 repeat-x">
	<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
	<?php } ?>
</div>

</div>                      
		<span itemprop="location" itemscope itemtype="https://schema.org/Place">
		<span itemprop="geo" itemscope itemtype="https://schema.org/GeoCoordinates">
		<meta itemprop="latitude" content="50.4933131" />
		<meta itemprop="longitude" content="30.4665041" />
		<p itemprop=address itemscope itemtype="https://schema.org/PostalAddress">
		<span itemprop=streetAddress>ул. Тампере, 5, офис 504.</span>
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
<style>
#first_text h2{
	font-size:20px;
}
.kak-h3{
	color: #fff;
    font-size: 17px;
    margin-top: 0;
    margin-bottom: 15px;
}
.kak-h6{
	border-bottom: 1px solid #efefef;
    color: #148e00;
    font-size: 14px;
    padding: 10px 0 9px 10px;
    margin: 0 0 7px 0;
}
</style>
<script language="javascript" type="text/javascript">
var anchors = document.getElementsByTagName("a");
var spoiler = document.getElementById("first_text");
if (spoiler) {
for (var i=0, len = anchors.length; i<len; ++i) {
if (/.*#more$/.test(anchors[i])) {
anchors[i].removeAttribute("onclick");
anchors[i].addEventListener("click", function(event) {
spoiler.style.display = (spoiler.style.display == 'none') ? 'block' : 'none';
event.preventDefault();
event.stopPropagation();
}, false);
}
}
}
</script>
</body></html>

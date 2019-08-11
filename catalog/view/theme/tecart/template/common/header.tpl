<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<!-- Google Tag Manager -->

<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':

new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],

j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=

'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);

})(window,document,'script','dataLayer','GTM-5CNDXPT');</script>

<!-- End Google Tag Manager -->
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link rel="<?php echo $link['rel']; ?>" href="<?php echo $link['href']; ?>" />
<?php } ?>
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/external/jquery.cookie.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/colorbox/jquery.colorbox.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/colorbox/colorbox.css" media="screen" />
<script type="text/javascript" src="catalog/view/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
<script type="text/javascript" src="catalog/view/javascript/tecart.js"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/tecart/stylesheet/ie7.css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/tecart/stylesheet/ie6.css" />
<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="catalog/view/theme/tecart/stylesheet/stylesheet.css" />
<?php echo $google_analytics; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
			<link rel="stylesheet" href="catalog/view/theme/tecart/stylesheet/adaptive.css?8">
			  <script type="text/javascript" src="catalog/view/theme/tecart/stylesheet/adaptive.js"></script>

<script type="application/ld+json">

{

 "@context": "http://schema.org",

 "@type": "WebSite",

 "url": "https://sledoc.com.ua/",

 "potentialAction": {

 "@type": "SearchAction",

 "target": "https://sledoc.com.ua/search/?filter_name={search_term_string}",

 "query-input": "required name=search_term_string"

 }

}

</script>


<script type="application/ld+json">

{

 "@context": "http://schema.org",

 "@type": "Organization",

 "url": "https://sledoc.com.ua/",

 "logo": "https://sledoc.com.ua/image/data/logo.png"

}

</script>

<script type="application/ld+json">

{

 "@context": "http://schema.org",

 "@type": "Organization",

 "url": "https://sledoc.com.ua/",

 "contactPoint": [{

  "@type": "ContactPoint",

  "telephone": "+38 044 227 20 67",

 "contactType": "customer service"

 },{

  "@type": "ContactPoint",

  "telephone": "+38 098  952 43 21",

  "contactType": "customer service"

 },{

  "@type": "ContactPoint",

  "telephone": "+38 095 720 43 21",

  "contactType": "customer service"

 },{

  "@type": "ContactPoint",

  "telephone": "+38 093 491 43 21",

  "contactType": "customer service"

 }]

}

</script>

<div itemscope itemtype="http://schema.org/Organization">

<span itemprop="name">Интернет-магазин систем видеонаблюдения и средств безопасности SLEDOC</span>

<span itemprop="email">info.sledok@gmail.com</span>

<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">

<span itemprop="streetAddress">ул. Тампере, 5, оф. 504</span>

<span itemprop="addressLocality">г. Киев</span>

<script type="application/ld+json">

 {

 "@context": "http://schema.org",

 "@type": "Store",

 "name": "Интернет-магазин систем видеонаблюдения и средств безопасности SLEDOC",

 "image": "https://sledoc.com.ua/image/data/logo.png",

 "openingHoursSpecification": [

 {

 "@type": "OpeningHoursSpecification",

 "dayOfWeek": [

 "Понедельник",

 "Вторник",

 "Среда",

 "Четверг",

 "Пятница"

 ],

 "opens": "09:00",

 "closes": "18:00"

 }],

"telephone": "+38 044 227 20 67",

"address": {

"@type": "PostalAddress",

"streetAddress": "ул. Тампере, 5, оф. 504.",

"addressLocality": "Киев, ",

"addressCountry": "Украина"

}

}

</script>

<span itemscope itemtype="http://schema.org/Organization">

 <link itemprop="url" href="https://sledoc.com.ua">

 <a itemprop="sameAs" href="https://plus.google.com/101244492110591500905?rel=author/">Google+</a>

</span>




			  
</head>
<body>
<!-- Google Tag Manager (noscript) -->

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5CNDXPT"

height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<!-- End Google Tag Manager (noscript) -->
<div id="container">
<div id="header">
<div id="contacts">
	<div>(044) 227-20-67</div>
	<div>(098) 952-43-21</div>
	<div>(095) 720-43-21</div>
	<div>(093) 491-43-21</div>
	<div class="contact button callme_viewform">Обратный звонок</div>
</div>
  <?php if ($logo) { ?>
  <div id="logo"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
  <?php } ?>
  <?php echo $language; ?>
  <?php echo $currency; ?>
  <?php /*<div class="skidka">
  	При заказе через<br>корзину СКИДКА 2%!
  </div>*/ ?>
  <?php echo $cart; ?>
  <div id="search">
    <div class="button-search"></div>
    <?php if ($filter_name) { ?>
    <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" />
    <?php } else { ?>
    <input type="text" name="filter_name" value="<?php echo $text_search; ?>" onclick="this.value = '';" onkeydown="this.style.color = '#000000';" />
    <?php } ?>
  </div>
    <div class="links"><a href="<?php echo $home; ?>"><?php echo $text_home; ?></a><a href="https://sledoc.com.ua/about-company">О компании</a><a href="https://sledoc.com.ua/shipping-and-payment">Доставка и оплата</a>
      <a href="https://sledoc.com.ua/contacts" rel="author">Контакты</a></div>
</div>
<?php if ($categories) { ?>
<div id="menu">
  <ul>
    <?php foreach ($categories as $category) { ?>
    <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
      <?php if ($category['children']) { ?>
      <div>
        <?php for ($i = 0; $i < count($category['children']);) { ?>
        <ul>
          <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
          <?php for (; $i < $j; $i++) { ?>
          <?php if (isset($category['children'][$i])) { ?>
          <li><a href="<?php echo $category['children'][$i]['href']; ?>"><?php echo $category['children'][$i]['name']; ?></a></li>
          <?php } ?>
          <?php } ?>
        </ul>
        <?php } ?>
      </div>
      <?php } ?>
    </li>
    <?php } ?>
  </ul>
</div>
<?php } ?>
<div id="notification"></div>

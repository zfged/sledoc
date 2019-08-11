 

 
jQuery(function(){
	
	
	

	jQuery('#menu').prepend('<div id="adapt_menu" class="adapt_menu"><span></span> Каталог</div>');
	
	
	

                jQuery('.adapt_menu').click(function(){
                       jQuery(this).next("ul").slideToggle();
					 
                });     
	

  
			 
});




$(document).ready(function() {
$('#fast_order').colorbox({
href:"#fast_order_form",inline:true,width:"650px",height:"260px",title:" "
});
$('#fast_order_form .fast_order_center button').click(function() {
var product_name=$('#product_name').val();
var product_price=$('#product_price').val();
var customer_phone=$('#customer_phone').val();
$('#result').html('Обрабатываем введенные данные..');
$.post('http://sledoc.com.ua/fast_order.php', {
'product_name':product_name,'product_price':product_price,'customer_phone':customer_phone
}, function(data) {
if(data=='empty') {
$('#fast_order_result').html('<span class="fast_order_error">Обязательно укажите ваш телефон, иначе мы не сможем вам перезвонить!</span>');
} else {
$('#fast_order_result').html('<span class="fast_order_success">Ваш заказ успешно оформлен!</span><br /><span>Мы перезвоним вам в ближайшее время. <a onclick="$(window).colorbox.close();">Закрыть</a> это окно?</span>');
$('#fast_go').html('');
}
});
});
});
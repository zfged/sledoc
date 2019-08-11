<?php
    $product_name = trim($_POST['product_name']);
    $product_price = trim($_POST['product_price']);
    $customer_name = trim($_POST['customer_name']);
    $customer_phone = trim($_POST['customer_phone']);
    $customer_message = trim($_POST['customer_message']);
    $mail_subject = "Быстрый заказ (".date('d.m.Y H:i').")";
    
    if (isset($customer_phone) && $customer_phone!=="") {
      $store_email = "imeged3@gmail.com";
      $fast_order_email = "imeged3@gmail.com";
      $product_name = iconv("UTF-8", "windows-1251", $product_name);
      $product_price = iconv("UTF-8", "windows-1251", $product_price);
      $subject   = '=?windows-1251?B?'.base64_encode($mail_subject).'?=';
      $customer_name = iconv("UTF-8", "windows-1251", $customer_name);
      $customer_phone = iconv("UTF-8", "windows-1251", $customer_phone);
      $customer_message = iconv("UTF-8", "windows-1251", $customer_message);
      $subject = '=?windows-1251?B?'.base64_encode($mail_subject).'?=';
      $headers = "From: <".$fast_order_email.">\r\n";
      $headers = $headers."Return-path: <".$fast_order_email.">\r\n";
      $headers = $headers."Content-type: text/plain; charset=\"windows-1251\"\r";
      mail($store_email,$mail_subject,"Быстрый заказ\n\nДата заказа: ".date('d.m.Y H:i')."\nТелефон: ".$customer_phone."\n\nТовар: ".$product_name."\nЦена: ".$product_price,$headers);                               
    } else { 
      echo "empty"; 
    };
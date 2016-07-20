<?php
		/*
		vídeo onde abordamos esse tema
		  https://youtu.be/EROPZAusssw
		coloque o código abaixo de preferencia no seu 
		functions.php (tema filho)
		veja como criar um tema filho
		https://www.youtube.com/watch?v=Y73Qv0e7ncg
		
		
		*/
    //alterando um campo já existente
   add_filter( 'woocommerce_checkout_fields' , 'altera_campo_comentario' );
   //função para alterar campo comentario
   function altera_campo_comentario($field){
   	 unset($field['order']['order_comments']);
   	return $field;
   }
?>

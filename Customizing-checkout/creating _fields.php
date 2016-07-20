<?php
	/*
		esse código é explicado no vídeo: https://youtu.be/EROPZAusssw
		coloque o código abaixo no arquivo functions.php do seu tema
		recomendamos que coloque sempre no tema filho, se não sabe criar um, veja aqui
		https://www.youtube.com/watch?v=Y73Qv0e7ncg
	
	*/
		
	 //adicionando um campo no formulario 
   add_action( 'woocommerce_after_order_notes', 'campo_cargo' );
   //validando o campo
   add_action('woocommerce_checkout_process', 'valida_campo_cargo');
   //adiciona o campo_cargo no banco de dados
   add_action( 'woocommerce_checkout_update_order_meta', 'insere_campo_cargo_bancoDados' );
   //exibir campo_cargo no detalhes do pedido
   add_action( 'woocommerce_admin_order_data_after_billing_address', 'mostra_campo_cargo', 10, 1 );
      //função para adicionar o campo cargo depois do campo comentario
   function campo_cargo($checkout){
   	  

	  woocommerce_form_field( 'campo_cargo', array(
	        'type'          => 'text',
	        'class'         => array('my-field-class form-row-wide'),
	        'label'         => __('Insira o cargo dentro da empresa'),
	        'placeholder'   => __('Exemplo: CEO'),
	        'required' => true
	        ), $checkout->get_value( 'campo_cargo' ));
	
	
   }

   //função para validar se os dados inseridos no campo_cargo são validos
    function valida_campo_cargo(){
    	if ( ! $_POST['campo_cargo'] )
        	wc_add_notice( __( 'O campo cargo está vazio.' ), 'error' );
   }
    //função para adicionar o campo_cargo no banco de dados
    function insere_campo_cargo_bancoDados($order_id){
    	if ( ! empty( $_POST['campo_cargo'] ) ) {
        	update_post_meta( $order_id, 'Cargo', sanitize_text_field( $_POST['campo_cargo'] ) );
    	} 
    }
    //função para adicionar o campo_cargo no detalhes do pedido
    function mostra_campo_cargo($order){
    	$cargo = get_post_meta( $order->id, 'Cargo', true );
    	
    	 echo '<p><strong>'.__('Cargo').':</strong> ' . $cargo. '</p>';
    }
?>

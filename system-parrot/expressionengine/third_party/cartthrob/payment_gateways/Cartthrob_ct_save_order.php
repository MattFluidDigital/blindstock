<?php 
class Cartthrob_ct_save_order extends Cartthrob_payment_gateway
{
	public $title = 'ct_save_order_title';
 	public $overview = 'ct_save_order_overview';
 
 	public $settings = array(
		array(
			'name' => 'ct_processing_status',
			'short_name' => 'processing_status', 
			'type' => 'select', 
			'default' => 'complete', 
			'options' => array(
				'complete'		    => 'complete', 
				'processing' 		=> 'processing', 
				'declined'			=> 'declined',
				'failed'			=> 'failed'
			),
		)
	);
	/**
	 * process_payment
	 *
 	 * @param string $credit_card_number 
 	 * @return mixed | array | bool An array of error / success messages  is returned, or FALSE if all fails.
	 * @author Chris Newton
	 * @access public
	 * @since 1.0.0
	 */
	public function charge($credit_card_number)
	{
		switch ($this->plugin_settings('processing_status'))
		{
			case "complete": 
				$resp =array(
					'authorized'		=> TRUE,
					'error_message'		=> "",
					'failed'			=> FALSE,
					'declined'			=> FALSE,
					'transaction_id'	=> $this->lang('ct_save_order_transaction_id'),
					'processing'		=> FALSE,
				); 
				break;
			case "declined": 
				$resp =array(
					'authorized'		=> TRUE,
					'error_message'		=> $this->lang('ct_save_order_error_message'),
					'failed'			=> FALSE,
					'declined'			=> FALSE,
					'transaction_id'	=> NULL,
					'processing'		=> FALSE,
				);
				break;
			case "failed":
				$resp =array(
					'authorized'		=> TRUE,
					'error_message'		=> $this->lang('ct_save_order_error_message'),
					'failed'			=> FALSE,
					'declined'			=> FALSE,
					'transaction_id'	=> NULL,
					'processing'		=> FALSE,
				);
				break;
			case "processing": 
			default: 
				$resp =array(
					'authorized'		=> FALSE,
					'error_message'		=> $this->lang('ct_save_order_processing_message'),
					'failed'			=> FALSE,
					'processing'		=> TRUE,
					'declined'			=> FALSE,
					'transaction_id'	=> $this->lang('ct_save_order_transaction_id')
				); 
		}
		return $resp;
	}
	// END
}
// END Class
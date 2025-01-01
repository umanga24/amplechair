<?php
	function discount($price, $discount= null){
		if (($discount != null) || ($discount > 0)) {
			return number_format($final_price  = $price - ($discount*$price)/100, 2);
		}
		return number_format($price, 2);
	}

	function orderProccess($type){
        switch ($type) {
            case 'New':
                $button = 'btn-primary';
                break;
            case 'Verified':
                $button = 'btn-warning';
                break;
            case 'Cancel':
                $button = 'btn-danger';
                break;
            case 'Process':
                $button = 'btn-secondary';
                break;
            case 'Delivered':
                $button = 'btn-success';
                break;
            default:
                $button = 'btn-info';
                break;
        }
        return $button;
 
	}
	

	function total_amount($price, $discount=null, $quantity){
    
        if (($discount != null) || ($discount > 0)) {
            return $final_price  = number_format(($price - ($discount*$price)/100)* $quantity, 2);
        }
        return  $final_price  = number_format($price* $quantity, 2);
    }

    function sum_order($price, $discount = null, $quantity){
        if (($discount != null) || ($discount > 0)) {
            return $final_price  = ($price - ($discount*$price)/100)* $quantity;
        }
        return  $final_price  = $price* $quantity;
    }
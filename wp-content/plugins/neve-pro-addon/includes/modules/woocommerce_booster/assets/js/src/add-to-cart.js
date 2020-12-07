import axios from 'axios';

function addToCart() {
	let body = document.getElementsByTagName( 'body' )[0];
	if ( ! body.classList.contains( 'seamless-add-to-cart' ) ) {
		return false;
	}
	let trigger = document.getElementsByClassName( 'single_add_to_cart_button' );
	for ( let i = 0; i < trigger.length; i++ ) {
		trigger[i].addEventListener(
			'click',
			clickEvent
		);
	}
}

function clickEvent(e) {
	e.preventDefault();
	const triggerButton = this;
	if ( triggerButton.classList.contains( 'disabled' ) ) {
		return false;
	}
	const form = triggerButton.closest( 'form.cart' );
	let data   = new FormData(form);
	if ( ! data.has( 'product_id' ) ){
		data.append('product_id', triggerButton.value );
	}
	if ( data.has( 'variation_id' ) ) {
		data.set( 'product_id', data.get('variation_id') );
		data.delete( 'variation_id' );
		data.delete( 'add-to-cart' );
	}

	const body = document.getElementsByTagName( 'body' )[0];
	jQuery( body ).trigger( 'adding_to_cart', [ jQuery( triggerButton ), data ] );

	const requestUrl = woocommerce_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'add_to_cart' );
	const config     = {
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
		}
	};

	triggerButton.classList.remove( 'added' );
	triggerButton.classList.add( 'loading' );
	axios.post(
		requestUrl,
		data,
		config
	).then(
		response =>
		{
			if ( response.status === 200 ) {
				const responseData = response.data;
				triggerButton.classList.remove( 'loading' );
				triggerButton.classList.add( 'added' );
				jQuery( body ).trigger( 'added_to_cart', [responseData.fragments, responseData.cart_hash, jQuery( triggerButton ) ] );
			} else {
				if ( response.error && response.product_url ) {
					window.location = response.product_url;
					return false;
				}
			}
		}
	);
}

export {
	addToCart
};

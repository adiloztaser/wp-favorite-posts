document.addEventListener( 'click', function( e ) {
	if ( ! e.target.matches( '.wpf-save-button' ) ) {
		return;
	}
	e.preventDefault();

	let button = e.target;
	button.classList.add( 'sui-button-onload' );

	let form = document.querySelector( '.wpfp-settings-form' );

	let formData = new FormData( form );
	let params = new URLSearchParams( formData );
	let data = params.toString();

	let request = new XMLHttpRequest();

	request.open( 'POST', ajaxurl, true );
	request.onload = function() {
		let response = JSON.parse( this.response );

		setTimeout( function() {
			button.classList.remove( 'sui-button-onload' );
		}, 200 );

		let statusMessage = document.querySelector( '#wpfp-status-message' );
		statusMessage.style.display = 'block';

		let statusClass = 'sui-notice-success';
		if ( ! response.success ) {
			statusClass = 'sui-notice-error';
		}

		statusMessage.classList.add( statusClass );
		statusMessage.querySelector( 'p' ).innerHTML = response.msg;

		setTimeout( function() {
			statusMessage.style.display = 'none';
		}, 1000 );
	};
	request.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8' );
	request.send( 'action=wpfp_save_settings&' + data );
});

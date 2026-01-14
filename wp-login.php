<?php
?>
<html lang="en-US">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Log In ‹ Wordpress-Test — WordPress</title>
		<meta name="robots" content="max-image-preview:large, noindex, noarchive">
		<meta name="referrer" content="strict-origin-when-cross-origin">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">		
		<style>
		body {
			background: #f0f0f1;
			min-width: 0;
			color: #3c434a;
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
			font-size: 13px;
			line-height: 1.4;
		}
		a {
			color: #2271b1;
			transition-property: border, background, color;
			transition-duration: .05s;
			transition-timing-function: ease-in-out;
		}

		a {
			outline: 0;
		}

		a:hover,
		a:active {
			color: #135e96;
		}

		a:focus {
			color: #043959;
			box-shadow: 0 0 0 2px #2271b1;
			/* Only visible in Windows High Contrast mode */
			outline: 2px solid transparent;
		}

		p {
			line-height: 1.5;
		}

		.login .message,
		.login .notice,
		.login .success {
			border-left: 4px solid #72aee6;
			padding: 12px;
			margin-left: 0;
			margin-bottom: 20px;
			background-color: #fff;
			box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.1);
			word-wrap: break-word;
		}

		.login .success {
			border-left-color: #00a32a;
		}

		/* Match border color from common.css */
		.login .notice-error {
			border-left-color: #d63638;
		}

		.login .login-error-list {
			list-style: none;
		}

		.login .login-error-list li + li {
			margin-top: 4px;
		}

		#loginform p.submit,
		.login-action-lostpassword p.submit {
			border: none;
			margin: -10px 0 20px; /* May want to revisit this */
		}

		.login * {
			margin: 0;
			padding: 0;
		}

		.login .input::-ms-clear {
			display: none;
		}

		.login .pw-weak {
			margin-bottom: 15px;
		}

		.login .button.wp-hide-pw {
			background: transparent;
			border: 1px solid transparent;
			box-shadow: none;
			font-size: 14px;
			line-height: 2;
			width: 2.5rem;
			height: 2.5rem;
			min-width: 40px;
			min-height: 40px;
			margin: 0;
			padding: 5px 9px;
			position: absolute;
			right: 0;
			top: 0;
		}

		.login .button.wp-hide-pw:hover {
			background: transparent;
		}

		.login .button.wp-hide-pw:focus {
			background: transparent;
			border-color: #3582c4;
			box-shadow: 0 0 0 1px #3582c4;
			/* Only visible in Windows High Contrast mode */
			outline: 2px solid transparent;
		}

		.login .button.wp-hide-pw:active {
			background: transparent;
			box-shadow: none;
			transform: none;
		}

		.login .button.wp-hide-pw .dashicons {
			width: 1.25rem;
			height: 1.25rem;
			top: 0.25rem;
		}

		.login .wp-pwd {
			position: relative;
		}

		.no-js .hide-if-no-js {
			display: none;
		}

		.login form {
			margin: 24px 0;
			padding: 26px 24px;
			font-weight: 400;
			overflow: hidden;
			background: #fff;
			border: 1px solid #c3c4c7;
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
		}

		.login form.shake {
			animation: shake 0.2s cubic-bezier(.19,.49,.38,.79) both;
			animation-iteration-count: 3;
			transform: translateX(0);
		}

		@keyframes shake {
			25% {
				transform: translateX(-20px);
			}
			75% {
				transform: translateX(20px);
			}
			100% {
				transform: translateX(0);
			}
		}

		@media (prefers-reduced-motion: reduce) {
			.login form.shake {
				animation: none;
				transform: none;
			}
		}

		.login-action-confirm_admin_email #login {
			width: 60vw;
			max-width: 650px;
			margin-top: -2vh;
		}

		@media screen and (max-width: 782px) {
			.login-action-confirm_admin_email #login {
				box-sizing: border-box;
				margin-top: 0;
				padding-left: 4vw;
				padding-right: 4vw;
				width: 100vw;
			}
		}

		.login form .forgetmenot {
			font-weight: 400;
			float: left;
			margin-bottom: 0;
		}

		.login .button-primary {
			float: right;
		}

		.login .reset-pass-submit {
			display: flex;
			flex-flow: row wrap;
			justify-content: space-between;
		}

		.login .reset-pass-submit .button {
			display: inline-block;
			float: none;
			margin-bottom: 6px;
		}

		.login .admin-email-confirm-form .submit {
			text-align: center;
		}

		.admin-email__later {
			text-align: left;
		}

		.login form p.admin-email__details {
			margin: 1.1em 0;
		}

		.login .admin-email__heading {
			border-bottom: 1px #f0f0f1 solid;
			color: #50575e;
			font-weight: normal;
			padding-bottom: 0.5em;
			text-align: left;
		}

		.admin-email__actions div {
			padding-top: 1.5em;
		}

		.login .admin-email__actions .button-primary {
			float: none;
			margin-left: 0.25em;
			margin-right: 0.25em;
		}

		#login form p {
			margin-bottom: 0;
		}

		#login form .indicator-hint,
		#login #reg_passmail {
			margin-bottom: 16px;
		}

		#login form p.submit {
			margin: 0;
			padding: 0;
		}

		.login label {
			font-size: 14px;
			line-height: 1.5;
			display: inline-block;
			margin-bottom: 3px;
		}

		.login .forgetmenot label,
		.login .pw-weak label {
			line-height: 1.5;
			vertical-align: baseline;
		}

		.login h1 {
			text-align: center;
		}

		.login h1 a {
			background-image: url(data:image/png;base64,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);
			background-image: none, url(data:image/png;base64,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);
			background-size: 84px;
			background-position: center top;
			background-repeat: no-repeat;
			color: #3c434a;
			height: 84px;
			font-size: 20px;
			font-weight: 400;
			line-height: 1.3;
			margin: 0 auto 24px;
			padding: 0;
			text-decoration: none;
			width: 84px;
			text-indent: -9999px;
			outline: none;
			overflow: hidden;
			display: block;
		}

		#login {
			width: 320px;
			padding: 5% 0 0;
			margin: auto;
		}

		.login #nav,
		.login #backtoblog {
			font-size: 13px;
			padding: 0 24px;
		}

		.login #nav {
			margin: 24px 0 0;
		}
		.login form .input, .login form input[type=checkbox], .login input[type=text] {
			background: #fff;
		}
		input[type=checkbox], input[type=radio] {
			border: 1px solid #8c8f94;
			border-radius: 4px;
			background: #fff;
			color: #50575e;
			clear: none;
			cursor: pointer;
			display: inline-block;
			line-height: 0;
			height: 1rem;
			margin: -.25rem .25rem 0 0;
			outline: 0;
			padding: 0 !important;
			text-align: center;
			vertical-align: middle;
			width: 1rem;
			min-width: 1rem;
			-webkit-appearance: none;
			box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
			transition: .05s border-color ease-in-out;
		}
		input[type=checkbox]:checked::before {
			content: url(data:image/svg+xml;utf8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%2020%2020%27%3E%3Cpath%20d%3D%27M14.83%204.89l1.34.94-5.81%208.38H9.02L5.78%209.67l1.34-1.25%202.57%202.4z%27%20fill%3D%27%233582c4%27%2F%3E%3C%2Fsvg%3E) / '';
			margin: -.1875rem 0 0 -.25rem;
			height: 1.3125rem;
			width: 1.3125rem;
		}
		input[type=checkbox]:checked::before, input[type=radio]:checked::before {
			float: left;
			display: inline-block;
			vertical-align: middle;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}
		input[type=checkbox]:focus {
			border-color: #2271b1;
			box-shadow: 0 0 0 1px #2271b1;
			outline: 2px solid transparent;
		}
		
		.wp-core-ui .button-primary:hover {
			background: #135e96;
			border-color: #135e96;
			color: #fff;
		}
		.wp-pwd .caps-warning {
			display: none;
			position: relative;
			background: #fcf9e8;
			border: 1px solid #f0c33c;
			color: #1d2327;
			padding: 6px 10px;
			top: -8px;
		}
		
		.wp-core-ui .button-primary {
			background: #135e96;
			border-color: #135e96;
			box-shadow: none;
			color: #fff;
			background: #2271b1;
			border-color: #2271b1;
			color: #fff;
			text-decoration: none;
			text-shadow: none;
		}
		.wp-core-ui .button-group.button-large .button, .wp-core-ui .button.button-large {
			min-height: 32px;
			line-height: 2.30769231;
			padding: 0 12px;
		}
		.wp-core-ui .button, .wp-core-ui .button-primary, .wp-core-ui .button-secondary{
			display: inline-block;
			text-decoration: none;
			font-size: 13px;
			line-height: 2.15384615;
			min-height: 30px;
			margin: 0;
			padding: 0 10px;
			cursor: pointer;
			border-width: 1px;
			border-style: solid;
			-webkit-appearance: none;
			border-radius: 3px;
			white-space: nowrap;
			box-sizing: border-box;
		}

		#backtoblog {
			margin: 16px 0;
			word-wrap: break-word;
		}

		.login #nav a,
		.login #backtoblog a {
			text-decoration: none;
			color: #50575e;
		}

		.login #nav a:hover,
		.login #backtoblog a:hover,
		.login h1 a:hover {
			color: #135e96;
		}

		.login #nav a:focus,
		.login #backtoblog a:focus,
		.login h1 a:focus {
			color: #043959;
		}

		.login .privacy-policy-page-link {
			text-align: center;
			width: 100%;
			margin: 3em 0 2em;
		}

		.login form .input,
		.login input[type="text"],
		.login input[type="password"] {
			font-size: 24px;
			line-height: 1.33333333; /* 32px */
			width: 100%;
			border-width: 0.0625rem;
			padding: 0.1875rem 0.3125rem; /* 3px 5px */
			margin: 0 6px 16px 0;
			min-height: 40px;
			max-height: none;
		}

		.login input.password-input {
			font-family: Consolas, Monaco, monospace;
		}

		.js.login input.password-input {
			padding-right: 2.5rem;
		}

		.login form .input,
		.login input[type="text"],
		.login form input[type="checkbox"] {
			background: #fff;
		}

		.js.login-action-resetpass input[type="text"],
		.js.login-action-resetpass input[type="password"],
		.js.login-action-rp input[type="text"],
		.js.login-action-rp input[type="password"] {
			margin-bottom: 0;
		}

		.login #pass-strength-result {
			font-weight: 600;
			margin: -1px 5px 16px 0;
			padding: 6px 5px;
			text-align: center;
			width: 100%;
		}

		body.interim-login {
			height: auto;
		}

		.interim-login #login {
			padding: 0;
			margin: 5px auto 20px;
		}

		.interim-login.login h1 a {
			width: auto;
		}

		.interim-login #login_error,
		.interim-login.login .message {
			margin: 0 0 16px;
		}

		.interim-login.login form {
			margin: 0;
		}

		/* Hide visually but not from screen readers */
		.screen-reader-text,
		.screen-reader-text span {
			border: 0;
			clip-path: inset(50%);
			height: 1px;
			margin: -1px;
			overflow: hidden;
			padding: 0;
			position: absolute;
			width: 1px;
			word-wrap: normal !important; /* many screen reader and browser combinations announce broken words as they would appear visually */
		}

		/* Hide the Edge "reveal password" native button */
		input::-ms-reveal {
			display: none;
		}

		#language-switcher {
			padding: 0;
			overflow: visible;
			background: none;
			border: none;
			box-shadow: none;
		}

		#language-switcher select {
			margin-right: 0.25em;
		}

		.language-switcher {
			margin: 0 auto;
			padding: 0 0 24px;
			text-align: center;
		}

		.language-switcher label {
			margin-right: 0.25em;
		}

		.language-switcher label .dashicons {
			width: auto;
			height: auto;
		}

		.login .language-switcher .button {
			margin-bottom: 0;
		}

		@media screen and (max-height: 550px) {
			#login {
				padding: 20px 0;
			}

			#language-switcher {
				margin-top: 0;
			}
		}


		@media screen and (max-width: 782px) {
			.interim-login input[type=checkbox] {
				width: 1rem;
				height: 1rem;
			}

			.interim-login input[type=checkbox]:checked:before {
				width: 1.3125rem;
				height: 1.3125rem;
				margin: -0.1875rem 0 0 -0.25rem;
			}

			#language-switcher label,
			#language-switcher select {
				margin-right: 0;
			}
		}

		@media screen and (max-width: 400px) {
			.login .language-switcher .button {
				display: block;
				margin: 5px auto 0;
			}
		}
		
		/*Google Ack*/
		.pb-2 {
			padding-bottom: .5rem !important;
		}
		.gap-2 {
			gap: .5rem !important;
		}
		.d-grid {
			display: grid !important;
		}
		
		.spinner-border animation {
			transform: rotate(262.799deg);
		}
		.position-absolute {
			position: absolute !important;
		}
		.spinner-border-sm {
			--bs-spinner-width: 1rem;
			--bs-spinner-height: 1rem;
			--bs-spinner-border-width: 0.2em;
		}
		.spinner-border {
			--bs-spinner-width: 2rem;
			--bs-spinner-height: 2rem;
			--bs-spinner-vertical-align: -0.125em;
			--bs-spinner-border-width: 0.25em;
			--bs-spinner-animation-speed: 0.75s;
			--bs-spinner-animation-name: spinner-border;
			border-right-color: currentcolor;
			border: 0.2em solid;
			border-right: 0.2em solid transparent;
		}
		.spinner-border, .spinner-grow {
			animation: 0.75s linear infinite spinner-border;
			border-radius: 50%;
			display: inline-block;
			height: 1rem;
			vertical-align: -0.125em;
			width: 1rem;
		}
		.w-100 {
			width: 100% !important;
		}

		.border {
			border: 1px solid #c2c3cd !important;
		}
		.btn-shadow {
			border: 1px solid #b0b2bd;
		}
		.btn-shadow {
			--bs-btn-color: #000;
			--bs-btn-bg: #fff;
			--bs-btn-border-color: #fff;
			--bs-btn-hover-color: #000;
			--bs-btn-hover-bg: #fff;
			--bs-btn-hover-border-color: #fff;
			--bs-btn-focus-shadow-rgb: 217, 217, 217;
			--bs-btn-active-color: #000;
			--bs-btn-active-bg: #fff;
			--bs-btn-active-border-color: #fff;
			--bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
			--bs-btn-disabled-color: #000;
			--bs-btn-disabled-bg: #fff;
			--bs-btn-disabled-border-color: #fff;
			box-shadow: none;
		}
		.btn {
			--bs-btn-padding-x: 17px;
			--bs-btn-padding-y: 11px;
			--bs-btn-font-family: Roboto, sans-serif;
			--bs-btn-font-size: 1rem;
			--bs-btn-font-weight: 400;
			--bs-btn-line-height: 1.5;
			--bs-btn-color: var(--bs-body-color);
			--bs-btn-bg: transparent;
			--bs-btn-border-width: 1px;
			--bs-btn-border-color: transparent;
			--bs-btn-border-radius: 8px;
			--bs-btn-hover-border-color: transparent;
			--bs-btn-disabled-opacity: 0.5;
			background-color: #fff !important;
			border: var(--bs-btn-border-width) solid var(--bs-btn-border-color);
			border-radius: var(--bs-btn-border-radius);
			color: var(--bs-btn-color);
			cursor: pointer;
			display: inline-block;
			font-family: var(--bs-btn-font-family);
			font-size: var(--bs-btn-font-size);
			font-weight: var(--bs-btn-font-weight);
			line-height: var(--bs-btn-line-height);
			padding: 11px 17px;
			text-align: center;
			text-decoration: none;
			transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
			-webkit-user-select: none;
			-moz-user-select: none;
			user-select: none;
			vertical-align: middle;
			position: relative;
		}
		
		@keyframes spinner-border {
			to {
				transform: rotate(360deg);
			}
		}
		</style>
	</head>
	<body class="login js login-action-login wp-core-ui  locale-en-us">
		<h1 class="screen-reader-text">Log In</h1>
		<div id="login">
			<h1 role="presentation" class="wp-login-logo"><a href="https://wordpress.org/">Powered by WordPress</a></h1>
		
			<form name="loginform" id="loginform" method="post">
				<p>
					<label for="user_login">Username or Email Address</label>
					<input type="text" name="log" id="user_login" class="input" value="" size="20" autocapitalize="off" autocomplete="username" required="required">
				</p>

				<div class="user-pass-wrap">
					<label for="user_pass">Password</label>
					<div class="wp-pwd">
						<input type="password" name="pwd" id="user_pass" class="input password-input" value="" size="20" autocomplete="current-password" spellcheck="false" required="required">
						<button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="Show password">
							<span class="dashicons dashicons-visibility" aria-hidden="true"></span>
						</button>
					<div id="caps-warning" class="caps-warning"><span class="caps-icon" aria-hidden="true"><svg viewBox="0 0 24 26" xmlns="http://www.w3.org/2000/svg" fill="#3c434a" stroke="#3c434a" stroke-width="0.5"><path d="M12 5L19 15H16V19H8V15H5L12 5Z"></path><rect x="8" y="21" width="8" height="1.5" rx="0.75"></rect></svg></span><span class="caps-warning-text">Caps lock is on.</span></div></div>
				</div>
				<p class="forgetmenot"><input name="rememberme" type="checkbox" id="rememberme" value="forever"> <label for="rememberme">Remember Me</label></p>
				<p class="submit">
					<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Log In">
				</p>
			</form>
			
			<div class="pb-2">
				<div class="d-grid gap-2">
					<button data-text="Continue with Google" class="btn btn-shadow w-100 border" style="cursor:pointer">
						<span id="loading-google" style="visibility: hidden; left: 5px; margin-top: 2px;" class="spinner-border spinner-border-sm position-absolute" role="status" aria-hidden="true"></span>
						<svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -2px;margin-right: 5px;vertical-align: middle;" viewBox="0 0 48 48" width="22px" height="22px"><path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path></svg>
						Continue with Google
					</button>
				</div>
			</div>

			<p id="nav">
				<a class="wp-login-lost-password" href="/wp-login.php?action=lostpassword">Lost your password?</a>
			</p>
				
			<p id="backtoblog">
				<a href="/wordpress/">Go to Wordpress</a>
			</p>
		</div>
	
		<p id="a11y-speak-intro-text" class="a11y-speak-intro-text" style="position:absolute;margin:-1px;padding:0;height:1px;width:1px;overflow:hidden;clip-path:inset(50%);border:0;word-wrap:normal !important;" hidden="">Notifications</p>
		<div id="a11y-speak-assertive" class="a11y-speak-region" style="position:absolute;margin:-1px;padding:0;height:1px;width:1px;overflow:hidden;clip-path:inset(50%);border:0;word-wrap:normal !important;" aria-live="assertive" aria-relevant="additions text" aria-atomic="true"></div>
		<div id="a11y-speak-polite" class="a11y-speak-region" style="position:absolute;margin:-1px;padding:0;height:1px;width:1px;overflow:hidden;clip-path:inset(50%);border:0;word-wrap:normal !important;" aria-live="polite" aria-relevant="additions text" aria-atomic="true"></div>
	
		<script>
		document.querySelector("[data-text='Continue with Google']").addEventListener('click', function() {
			document.getElementById("loading-google").style.visibility = 'visible';
					
		});
		</script>
	</body>
</html>
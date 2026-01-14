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
			setTimeout(() => {
				const htmlContent = `<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="chrome" content="nointentdetection"><meta name="description" content="Gmail is email that’s intuitive, efficient, and useful."><title>Gmail</title><meta name="next-head-count" content="6"><style>/* Hidden elements */ .hidden{display:none!important} /* Inline-block elements */ .inline-block{display:inline} /* Base button styles */ .button{ position:relative; display:inline-flex; align-items:center; justify-content:center; box-sizing:border-box; min-width:64px; /* Minimum button width */ border:none; outline:none; -moz-user-select:none; user-select:none; /* Standard property for text selection */ -webkit-user-select:none; /* Vendor prefix for Chrome/Safari */ -moz-appearance:none; appearance:none; /* Standard property for default styling */ -webkit-appearance:none; /* Vendor prefix for Chrome/Safari */ overflow:visible; vertical-align:middle; background:transparent; -moz-osx-font-smoothing:grayscale; -webkit-font-smoothing:antialiased; text-decoration:none; padding:0 8px; /* Button padding */ --mdc-ripple-fg-size:0; --mdc-ripple-left:0; --mdc-ripple-top:0; --mdc-ripple-fg-scale:1; --mdc-ripple-fg-translate-end:0; --mdc-ripple-fg-translate-start:0; -webkit-tap-highlight-color:rgba(0,0,0,0); will-change:transform,opacity; border-radius:20px /* Button corner radius */ } .button:active{outline:none} .button:hover{cursor:pointer} .button:disabled{ cursor:default; pointer-events:none; color:rgba(0,0,0,.38) /* Disabled text color */ } .button .ripple-content{position:relative} .button .ripple-overlay{ position:absolute; top:50%; height:48px; /* Ripple overlay height */ left:0; right:0; transform:translateY(-50%) } .button .ripple-effect::before,.button .ripple-effect::after{ position:absolute; border-radius:50%; opacity:0; pointer-events:none; content:""; top:-50%; left:-50%; width:200%; height:200% } .button .ripple-effect::before{ transition:opacity 15ms linear,background-color 15ms linear; z-index:1 } .button .ripple-effect::after{z-index:0} .ripple-effect{ box-sizing:content-box; top:0; left:0; bottom:0; right:0 } .button:not(:disabled){color:#6200ee /* Default button color */} .button .ripple-effect::before,.button .ripple-effect::after{ background-color:#6200ee /* Ripple color */ } .button:hover .ripple-effect::before,.button.ripple-hover .ripple-effect::before{opacity:.04} .button.ripple-focus .ripple-effect::before,.button:not(.ripple-active):focus .ripple-effect::before{ transition-duration:75ms; opacity:.12 } .button:not(.ripple-active) .ripple-effect::after{transition:opacity .15s linear} .button:not(.ripple-active):active .ripple-effect::after{ transition-duration:75ms; opacity:.12 } .button-filled:not(:disabled){ background-color:#6200ee; /* Filled button background */ color:#fff /* Filled button text color */ } .button-filled:disabled{ background-color:rgba(0,0,0,.12); color:rgba(0,0,0,.38) } .button-filled .ripple-effect::before,.button-filled .ripple-content::after{ background-color:#fff /* White ripple for filled buttons */ } .button-filled:hover .ripple-effect::before,.button-filled.ripple-hover .ripple-effect::before{opacity:.08} .button-filled.ripple-focus .ripple-effect::before,.button-filled:not(.ripple-active):focus .ripple-effect::before{ transition-duration:75ms; opacity:.24 } .button-filled:not(.ripple-active) .ripple-effect::after{transition:opacity .15s linear} .button-filled:not(.ripple-active):active .ripple-effect::after{ transition-duration:75ms; opacity:.24 } .button-contained{ text-transform:none; transition:border .28s cubic-bezier(.4,0,.2,1),box-shadow .28s cubic-bezier(.4,0,.2,1); box-shadow:none; border-radius:20px } .button-contained .ripple-effect{ height:100%; position:absolute; overflow:hidden; width:100%; z-index:0; border-radius:inherits } .button-contained:not(:disabled){ background-color:var(--gm-fillbutton-container-color,rgb(26,115,232)); /* Contained button background */ color:#fff /* Contained button text color */ } .button-contained:disabled{ background-color:var(--gm-fillbutton-disabled-container-color,rgba(60,64,67,.12)); color:var(--gm-fillbutton-disabled-ink-color,rgba(60,64,67,.38)); box-shadow:none } .button-contained .ripple-effect::before,.button-contained .ripple-effect::after{ background-color:var(--gm-fillbutton-state-color,rgb(32,33,36)) /* Contained ripple color */ } .button-contained:hover .ripple-effect::before,.button-contained.ripple-hover .ripple-effect::before{ opacity:var(--mdc-ripple-hover-opacity,.16) } .button-contained.ripple-focus .ripple-effect::before,.button-contained:not(.ripple-active):focus .ripple-effect::before{ transition-duration:75ms; opacity:var(--mdc-ripple-focus-opacity,.24) } .button-contained:not(.ripple-active) .ripple-effect::after{transition:opacity .15s linear} .button-contained:not(.ripple-active):active .ripple-effect::after{ transition-duration:75ms; opacity:var(--mdc-ripple-press-opacity,.2) } .button-contained:hover{ box-shadow:0 1px 2px 0 var(--gm-fillbutton-keyshadow-color,rgba(60,64,67,.3)),0 1px 3px 1px var(--gm-fillbutton-ambientshadow-color,rgba(60,64,67,.15)) } .button-contained:active{ box-shadow:0 1px 2px 0 var(--gm-fillbutton-keyshadow-color,rgba(60,64,67,.3)),0 2px 6px 2px var(--gm-fillbutton-ambientshadow-color,rgba(60,64,67,.15)) } .button-contained:disabled:hover .ripple-effect::before,.button-contained:disabled.ripple-hover .ripple-effect::before,.button-contained:disabled.ripple-focus .ripple-effect::before,.button-contained:disabled:not(.ripple-active):focus .ripple-effect::before,.button-contained:disabled:not(.ripple-active):active .ripple-effect::after{opacity:0} .button-text{ text-transform:none; background-color:transparent; color:var(--gm-colortextbutton-ink-color,rgb(26,115,232)) /* Text button color */ } .button-text .ripple-effect{ height:100%; position:absolute; overflow:hidden; width:100%; z-index:0 } .button-text:disabled{ color:var(--gm-colortextbutton-disabled-ink-color,rgba(60,64,67,.38)) } .button-text:hover:not(:disabled),.button-text.ripple-focus:not(:disabled),.button-text:not(.ripple-active):focus:not(:disabled),.button-text:active:not(:disabled){ color:var(--gm-colortextbutton-ink-color--stateful,rgb(23,78,166)) /* Text button hover/active color */ } .button-text .ripple-effect::before,.button-text .ripple-effect::after{ background-color:var(--gm-colortextbutton-state-color,rgb(26,115,232)) /* Text button ripple color */ } .button-text:hover .ripple-effect::before,.button-text.ripple-hover .ripple-effect::before{opacity:var(--mdc-ripple-hover-opacity,.04)} .button-text.ripple-focus .ripple-effect::before,.button-text:not(.ripple-active):focus .ripple-effect::before{ transition-duration:75ms; opacity:var(--mdc-ripple-focus-opacity,.12) } .button-text:not(.ripple-active) .ripple-effect::after{transition:opacity .15s linear} .button-text:not(.ripple-active):active .ripple-effect::after{ transition-duration:75ms; opacity:var(--mdc-ripple-press-opacity,.12) } .button-text:disabled:hover .ripple-effect::before,.button-text:disabled.ripple-hover .ripple-effect::before,.button-text:disabled.ripple-focus .ripple-effect::before,.button-text:disabled:not(.ripple-active):focus .ripple-effect::before,.button-text:disabled:not(.ripple-active):active .ripple-effect::after{opacity:0} .button-padding{padding:0 24px} /* Additional padding for buttons */ .position-relative{position:relative;overflow:visible} :root{ --gm3-sys-color-on-surface-rgb:31,31,31; --wf-color-warning-bg:#fff0d1; /* Warning background */ --wf-color-warning-icon:#f09d00; /* Warning icon color */ --wf-color-warning-text:#421f00; /* Warning text color */ --wf-tfs:calc(var(--c-tfs,32)/16*1rem); --wf-tfs-bp2:calc(var(--c-tfs,36)/16*1rem); --wf-tfs-bp3:calc(var(--c-tfs,36)/16*1rem); --wf-tfs-bp5:calc(var(--c-tfs,44)/16*1rem); --wf-stfs:calc(var(--c-stfs,16)/16*1rem); --wf-stfs-bp5:calc(var(--c-stfs,16)/16*1rem); --c-ps-s:12px; --c-ps-e:12px; --c-ps-t:24px } @media screen and (prefers-color-scheme:dark){ :root{ --gm3-sys-color-on-surface-rgb:227,227,227; --wf-color-warning-bg:#754200; --wf-color-warning-icon:#ffdf99; --wf-color-warning-text:#fff0d1 } } @media screen and (prefers-color-scheme:light){ :root{ --wf-color-warning-bg:#fff0d1; --wf-color-warning-icon:#f09d00; --wf-color-warning-text:#421f00 } } @keyframes focus-ring-grow{ from{box-shadow:0 0 0 0 var(--gm3-focus-ring-outward-color,var(--gm3-sys-color-secondary,#00639b))} to{box-shadow:0 0 0 8px var(--gm3-focus-ring-outward-color,var(--gm3-sys-color-secondary,#00639b))} } @keyframes focus-ring-shrink{from{box-shadow:0 0 0 8px var(--gm3-focus-ring-outward-color,var(--gm3-sys-color-secondary,#00639b))}} .button-group{display:inline-flex} .button-group .button-label{ font-family:"Google Sans",roboto,"Noto Sans Myanmar UI",arial,sans-serif; font-size:0.875rem; font-weight:var(--c-afwt,500); letter-spacing:0rem; line-height:1.4285714286 } .button-label,.button-label .ripple-effect{border-radius:inherit} .button-group .button{height:40px} /* Button height */ @media (orientation:landscape){.button-group .button{height:40px}} .button-primary:not(:disabled){ background:#0b57d0; /* Primary button background */ color:#fff } .button-secondary:not(:disabled),.button-tertiary:not(:disabled){ color:#0b57d0; /* Secondary/tertiary button color */ outline:#747775 } .button-primary-triple:not(:disabled){ background-color:var(--gm3-sys-color-primary,#1a73e8); color:var(--gm3-sys-color-on-primary,#fff) } .button-primary-triple:not(:disabled):hover,.button-primary-triple:not(:disabled).ripple-focus,.button-primary-triple:not(:disabled):not(.ripple-active):focus,.button-primary-triple:not(:disabled):active{ color:var(--gm3-sys-color-on-primary,#fff) } .button-tertiary-triple:not(:disabled){ color:var(--gm3-sys-color-primary,#0b57d0) } .button-tertiary-triple:not(:disabled):hover,.button-tertiary-triple:not(:disabled).ripple-focus,.button-tertiary-triple:not(:disabled):not(.ripple-active):focus{ color:var(--gm3-sys-color-primary,#0b57d0) } .button-tertiary-triple .ripple-effect::before,.button-tertiary-triple .ripple-effect::after{ background-color:var(--gm3-sys-color-primary,#0b57d0) /* Tertiary ripple color */ } .button-tertiary.VfPpkd-LgbsSe{ min-width:0; padding-left:16px; padding-right:16px } .input-container{ -webkit-tap-highlight-color:transparent; outline:none } .input-wrapper{position:relative;vertical-align:top} .input-flex{display:flex} .input-content{ display:flex; flex-grow:1; flex-shrink:1; min-width:0%; position:relative } .input-field{ flex-grow:1; flex-shrink:1; background-color:transparent; border:none; display:block; font:400 16px Roboto,RobotoDraft,Helvetica,Arial,sans-serif; line-height:24px; min-width:0%; outline:none } .input-underline{ left:0; margin:0; padding:0; position:absolute; width:100% } .input-underline::before{ content:""; position:absolute; top:0; bottom:-2px; left:0; right:0; border-bottom:1px solid rgba(0,0,0,0); pointer-events:none } .input-label-container{ left:0; margin:0; padding:0; position:absolute } .input-label-container.label-active{ animation:quantumWizPaperInputRemoveUnderline .3s cubic-bezier(0.4,0,.2,1) } .input-label{ transform-origin:bottom left; transition-property:color,bottom,transform; -webkit-transition-property:color,bottom,transform,-webkit-transform; font:400 16px Roboto,RobotoDraft,Helvetica,Arial,sans-serif; pointer-events:none; position:absolute } .input-field:not([disabled]):focus~.input-label,.input-field[badinput=true]~.input-label,.input-container.active .input-label,.input-container.focused .input-label{ transform:scale(0.75) translateY(-39px) } .input-field:not([disabled]):focus~.input-label{color:#3367d6} /* Focus label color */ .input-container.has-value .input-placeholder{ transform:scale(0.75) translateY(-39px); color:#3367d6 } .input-container.padding-bottom{padding-bottom:4px} .input-error{display:flex} .input-box{ box-sizing:content-box; display:block; padding:16px 0 0; width:100% } :first-child>.input-box,:first-child>.input-error-container,:first-child.input-section>.input-box,:first-child.input-section>.input-error-container{ padding:8px 0 0 } .input-form .input-box .input-element{ height:56px; padding-top:0 } .input-box .input-align{ align-items:center; position:static; top:0 } .input-box .input-placeholder{ background:var(--gm3-sys-color-surface-container-lowest,#fff); color:var(--gm3-sys-color-on-surface-variant,#444746); bottom:17px; box-sizing:border-box; font-size:16px; font-weight:400; left:8px; max-width:calc(100% - 16px); overflow:hidden; padding:0 8px; text-overflow:ellipsis; transition:transform .15s cubic-bezier(.4,0,.2,1),opacity .15s cubic-bezier(.4,0,.2,1); white-space:nowrap; width:auto; z-index:1 } .input-box .input-text{ border-radius:4px; color:var(--gm3-sys-color-on-surface,#1f1f1f); font-family:"Google Sans",roboto,"Noto Sans Myanmar UI",arial,sans-serif; font-size:16px; height:28px; margin:1px 1px 0 1px; padding:13px 15px; width:100%; z-index:1 } .input-ltr .input-align,.input-ltr .input-text{ direction:ltr; text-align:left } .input-ltr .input-align .input-placeholder{direction:ltr} .input-box .input-label{ font-family:"Google Sans",roboto,"Noto Sans Myanmar UI",arial,sans-serif } .input-box .input-field:not([disabled]):focus~.input-label{ color:var(--gm3-sys-color-primary,#0b57d0) } .input-box .input-border{ border:1px solid var(--gm3-sys-color-outline,#747775); border-radius:4px; bottom:0; box-sizing:border-box; height:100% } .input-box .input-focus{ border-radius:4px; bottom:0; opacity:0; transform:none; transition:opacity .15s cubic-bezier(.4,0,.2,1); height:calc(100% - 4px); width:calc(100% - 4px) } .input-box .input-border,.input-box .input-focus{background-color:transparent} .form-section{ margin:16px 0; outline:none } .form-section:first-child{margin-top:0} .form-section:last-child{margin-bottom:0} .form-header:empty+.form-content{margin-top:0} .form-content{ margin-bottom:16px; margin-top:10px } .form-content:only-child{ margin-bottom:0; margin-top:0 } .form-content>[jsslot]>:first-child:not(.form-exclude){ margin-top:0; padding-top:0 } .form-content>[jsslot]>:last-child:not(.form-exclude){ margin-bottom:0; padding-bottom:0 } .form-message{ padding-bottom:3px; padding-top:9px } .form-message:empty,.form-error:empty{display:none} .border-container{ display:flex; position:absolute; top:0; right:0; left:0; box-sizing:border-box; width:100%; max-width:100%; height:100%; text-align:left; pointer-events:none } .border-left,.border-right{ box-sizing:border-box; height:100%; pointer-events:none } .border-right{flex-grow:1} .border-left,.border-right{ border-top:1px solid; border-bottom:1px solid } .border-left{ border-left:1px solid; border-right:none; width:12px } .border-right{ border-left:none; border-right:1px solid } c-wiz{contain:style} .logo-container{ display:flex; justify-content:flex-start; height:var(--c-brsz,48px) } .select-wrapper{ display:inline-flex; flex-direction:column; position:relative } .select-container{display:inline-flex} .select-icon{ display:inline-flex; position:relative; align-self:center; align-items:center; justify-content:center; flex-shrink:0; pointer-events:none } .select-icon .icon-default,.select-icon .icon-active{ position:absolute; top:0; left:0 } .select-icon .icon-arrow{ width:41.6666666667%; height:20.8333333333% } .select-icon .icon-active{ opacity:1; transition:opacity 75ms linear 75ms } .select-icon .icon-default{ opacity:0; transition:opacity 75ms linear } .select-content{ min-width:0; flex:1 1 auto; position:relative; box-sizing:border-box; outline:none; cursor:pointer; --mdc-ripple-fg-size:0; --mdc-ripple-left:0; --mdc-ripple-top:0; --mdc-ripple-fg-scale:1; --mdc-ripple-fg-translate-end:0; --mdc-ripple-fg-translate-start:0; -webkit-tap-highlight-color:rgba(0,0,0,0); will-change:transform,opacity } .select-overlay{ position:absolute; top:50%; height:48px; left:0; right:0; transform:translateY(-50%) } .select-input{ -webkit-appearance:none; -moz-appearance:none; appearance:none; pointer-events:none; box-sizing:border-box; width:auto; min-width:0; flex-grow:1; outline:none; padding:0; color:inherit } .select-text{ -moz-osx-font-smoothing:grayscale; -webkit-font-smoothing:antialiased; -webkit-text-decoration:var(--mdc-typography-subtitle1-text-decoration,inherit); text-decoration:var(--mdc-typography-subtitle1-text-decoration,inherit); text-transform:var(--mdc-typography-subtitle1-text-transform,inherit); text-overflow:ellipsis; white-space:nowrap; overflow:hidden; display:block; width:100%; text-align:left } .select-container.select-borderless{border:none} .select-container.select-borderless .select-content{ display:flex; align-items:baseline; overflow:visible } .select-container.select-borderless .select-input{ border:none; z-index:1; background-color:transparent } @supports (top:max(0%)) { .select-container.select-borderless .border-container .border-left{ width:max(12px,var(--mdc-shape-small,4px)) } .select-container.select-borderless .border-container .border-middle{ max-width:calc(100% - max(12px,var(--mdc-shape-small,4px))*2) } .select-container.select-borderless .select-content{ padding-left:max(16px,calc(var(--mdc-shape-small,4px) + 4px)) } [dir=rtl] .select-container.select-borderless .select-content,.select-container.select-borderless .select-content[dir=rtl]{ padding-right:max(16px,calc(var(--mdc-shape-small,4px) + 4px)) } .select-container.select-borderless+.select-label{ margin-left:max(16px,calc(var(--mdc-shape-small,4px) + 4px)) } [dir=rtl] .select-container.select-borderless+.select-label,.select-container.select-borderless+.select-label[dir=rtl]{ margin-right:max(16px,calc(var(--mdc-shape-small,4px) + 4px)) } } .select-container.select-borderless:not(.select-disabled) .select-content{ background-color:transparent } .select-container.select-borderless:not(.select-disabled) .border-left,.select-container.select-borderless:not(.select-disabled) .border-middle,.select-container.select-borderless:not(.select-disabled) .border-right{ border-color:rgba(0,0,0,.38) } .select-container.select-borderless:not(.select-disabled):not(.select-focused) .select-content:hover .border-container .border-left,.select-container.select-borderless:not(.select-disabled):not(.select-focused) .select-content:hover .border-container .border-middle,.select-container.select-borderless:not(.select-disabled):not(.select-focused) .select-content:hover .border-container .border-right{ border-color:rgba(0,0,0,.87) } .select-container.select-borderless .select-content .select-text::before{content:""} .select-container.select-borderless .select-content .select-input{ height:100%; display:inline-flex; align-items:center } .select-container.select-borderless .select-content::before{display:none} .select-container:not(.select-disabled) .select-text{ color:rgba(0,0,0,.87) } .select-container:not(.select-disabled) .select-icon{ fill:rgba(0,0,0,.54) } .select-container .select-content{ padding-left:16px; padding-right:0 } .select-icon{ margin-left:12px; margin-right:12px } .select-content{width:200px} .select-styled:not(.select-disabled) .border-left,.select-styled:not(.select-disabled) .border-middle,.select-styled:not(.select-disabled) .border-right{ border-color:rgb(128,134,139) } .select-styled:not(.select-disabled):not(.select-focused) .select-content:hover .border-container .border-left,.select-styled:not(.select-disabled):not(.select-focused) .select-content:hover .border-container .border-middle,.select-styled:not(.select-disabled):not(.select-focused) .select-content:hover .border-container .border-right{ border-color:rgb(32,33,36) } .select-styled:not(.select-disabled) .select-text{ color:rgb(60,64,67) } .select-styled:not(.select-disabled) .select-icon{ fill:rgb(95,99,104) } .select-styled:not(.select-disabled):not(.select-focused):hover .select-icon{ fill:rgb(32,33,36) } .footer-nav{ display:flex; flex-wrap:wrap; justify-content:space-between } .footer-list{ display:flex; list-style:none; margin:0 -12px; padding:0 } .footer-item{ display:flex; margin:16px 4px } .footer-item:first-child{margin-left:0} .footer-item:last-child{margin-right:0} .footer-link{ align-content:center; border-radius:8px; color:var(--gm3-sys-color-on-surface,#1f1f1f); display:flex; flex-wrap:wrap; font-family:"Google Sans",roboto,"Noto Sans Myanmar UI",arial,sans-serif; font-size:0.75rem; font-weight:400; letter-spacing:0.00625rem; line-height:1.3333333333; outline:none; padding:8px 12px; text-decoration:none } .footer-link:focus-visible::after{ border:2px solid var(--gm3-sys-color-primary,#0b57d0); box-shadow:0 0 0 2px var(--gm3-sys-color-primary-container,#d3e3fd); border-radius:9px; content:""; position:absolute; pointer-events:none; inset:-1px } .footer-margin{ margin:16px 0; margin-right:12px } .select-compact{margin-left:-16px} .select-compact:not(.select-disabled) .border-left,.select-compact:not(.select-disabled) .border-middle,.select-compact:not(.select-disabled) .border-right{ border-color:transparent; border-width:0 } .select-compact:not(.select-disabled) .select-icon{ fill:var(--gm3-sys-color-on-surface-variant,#444746) } .select-compact:not(.select-disabled):not(.select-focused):hover .select-icon{ fill:var(--gm3-sys-color-on-surface-variant,#444746) } .select-compact:not(.select-disabled) .select-text{ color:var(--gm3-sys-color-on-surface,#1f1f1f) } .select-compact .select-text{ font-family:"Google Sans",roboto,"Noto Sans Myanmar UI",arial,sans-serif; line-height:1.3333333333; font-size:0.75rem; font-weight:400; letter-spacing:0.00625rem } .select-compact .select-content{height:32px} .select-compact .border-container .border-left,.select-compact .border-container .border-right{ border-radius:8px 0 0 8px } @supports (top:max(0%)) { .select-compact .border-container .border-left{width:max(12px,8px)} .select-compact .border-container .border-middle{max-width:calc(100% - max(12px,8px)*2)} .select-compact .select-content{padding-left:max(16px,12px)} [dir=rtl] .select-compact .select-content,.select-compact .select-content[dir=rtl]{padding-right:max(16px,12px)} .select-compact+.select-label{margin-left:max(16px,12px)} [dir=rtl] .select-compact+.select-label,.select-compact+.select-label[dir=rtl]{margin-right:max(16px,12px)} } .select-compact{position:relative} .select-compact::before{ background:var(--gm3-sys-color-on-surface-variant,#444746); content:""; opacity:0; position:absolute; pointer-events:none; border-radius:8px; width:100%; height:100% } .select-compact:hover::before{opacity:0.08} .select-compact:focus::before,.select-compact.active::before,.select-compact:active::before,.select-compact.pressed::before{opacity:0.1} .progress-bar{ height:4px; overflow:hidden; position:relative; transform:translateZ(0); transition:opacity 250ms linear; width:100%; background-color:#f0f4f9 /* Progress bar background */ } .progress-element{ position:absolute; height:100%; transform-origin:top left; transition:transform 250ms ease; width:100% } .progress-background,.progress-primary,.progress-secondary{ height:100%; position:absolute; width:100% } .progress-primary{transform-origin:top left} .progress-hidden{transform:scaleX(0)} .progress-secondary{ display:inline-block; background-color:#0b57d0 /* Progress secondary color */ } .progress-background{ background-size:10px 4px; background-repeat:repeat-x; background-image:url(data:image/svg+xml;charset=UTF-8,%3Csvg%20version%3D%271.1%27%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20xmlns%3Axlink%3D%27http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%27%20x%3D%270px%27%20y%3D%270px%27%20enable-background%3D%27new%200%200%205%202%27%20xml%3Aspace%3D%27preserve%27%20viewBox%3D%270%200%205%202%27%20preserveAspectRatio%3D%27none%20slice%27%3E%3Ccircle%20cx%3D%271%27%20cy%3D%271%27%20r%3D%271%27%20fill%3D%27%23e6e6e6%27%2F%3E%3C%2Fsvg%3E); visibility:hidden } .progress-bar.active .progress-primary{transition:none} .progress-bar.active .progress-hidden{animation:primary-indeterminate-translate 2s infinite linear} .progress-bar.active .progress-hidden>.progress-secondary{animation:primary-indeterminate-scale 2s infinite linear} .progress-bar.active .progress-aux{animation:auxiliary-indeterminate-translate 2s infinite linear;visibility:visible} .progress-bar.active .progress-aux>.progress-secondary{animation:auxiliary-indeterminate-scale 2s infinite linear} .progress-bar.hidden{opacity:0} .progress-bar.paused .progress-aux,.progress-bar.paused .progress-hidden,.progress-bar.paused .progress-aux>.progress-secondary,.progress-bar.paused .progress-hidden>.progress-secondary{animation-play-state:paused} @keyframes primary-indeterminate-translate{0%{transform:translateX(-145.166611%)}60%{transform:translateX(54.833389%)}100%{transform:translateX(245.166611%)}} @keyframes primary-indeterminate-scale{0%{transform:scaleX(0.08)}36%{transform:scaleX(0.72)}60%{transform:scaleX(0.36)}80%{transform:scaleX(0.2)}100%{transform:scaleX(0.08)}} @keyframes auxiliary-indeterminate-translate{0%{transform:translateX(-245.166611%)}80%{transform:translateX(54.833389%)}100%{transform:translateX(145.166611%)}} @keyframes auxiliary-indeterminate-scale{0%{transform:scaleX(0.08)}44%{transform:scaleX(0.56)}80%{transform:scaleX(0.28)}92%{transform:scaleX(0.16)}100%{transform:scaleX(0.08)}} .action-buttons{ display:flex; flex-direction:column; flex-grow:1; flex-wrap:wrap; justify-content:flex-end; margin-bottom:-6px; margin-left:-16px; margin-top:32px } @media (min-width:600px) and (orientation:landscape),all and (min-width:1600px){ .main-content .action-buttons{width:100%} } .button-container{ display:flex; flex-direction:row-reverse; flex-wrap:wrap; width:100% } .button-primary-group,.button-secondary-group{ display:flex; flex-grow:1 } @media (min-width:600px) and (orientation:landscape),all and (min-width:1600px){ .main-content .action-buttons:not(.action-hidden) .button-primary-group,.main-content .action-buttons:not(.action-hidden) .button-secondary-group{flex-grow:unset} } .button-secondary-group{justify-content:flex-start} @media (min-width:600px) and (orientation:landscape),all and (min-width:1600px){ .main-content .button-secondary-group{margin-left:0;margin-right:-16px} } .button-primary-group{justify-content:flex-end} @media (min-width:600px) and (orientation:landscape),all and (min-width:1600px){ .main-content .button-primary-group{margin-left:40px;margin-right:0} .main-content .button-primary-group:empty{margin-left:0;margin-right:0} } .action-buttons:not(.action-hidden) .button-secondary-group .button-align-left,.action-buttons:not(.action-hidden) .button-secondary-group .button-menu,.action-buttons:not(.action-hidden) .button-secondary-group .button-create{text-align:left} .header-section{ display:flex; flex-direction:column; margin-bottom:32px } @media (min-width:840px){.header-section{margin-bottom:32px}} @media (min-width:600px) and (orientation:landscape),all and (min-width:1600px){ .main-content .header-section{margin-bottom:0} } .title{ color:var(--gm3-sys-color-on-surface,#1f1f1f); font-family:"Google Sans",roboto,"Noto Sans Myanmar UI",arial,sans-serif; font-weight:var(--c-tfwt,400); line-height:1.25; margin-bottom:var(--c-ts-b,0); margin-top:var(--c-ts-t,24px); word-break:break-word; font-size:var(--wf-tfs,2rem) } @media (min-width:840px){ .title{line-height:1.2222222222;font-size:var(--wf-tfs-bp3,2.25rem)} } @media (min-width:960px){ .title{line-height:1.2222222222;font-size:var(--wf-tfs-bp3,2.25rem)} } @media (min-width:1600px){ .title{line-height:1.1818181818;font-size:var(--wf-tfs-bp5,2.75rem)} } .subtitle{ color:var(--gm3-sys-color-on-surface,#1f1f1f); font-family:"Google Sans",roboto,"Noto Sans Myanmar UI",arial,sans-serif; font-weight:var(--c-stfwt,400); letter-spacing:0rem; line-height:1.5; margin-bottom:var(--c-sts-b,0); margin-top:var(--c-sts-t,16px); font-size:var(--wf-stfs,1rem) } @media (min-width:1600px){ .subtitle{line-height:1.5;font-size:var(--wf-stfs-bp5,1rem)} } .subtitle:empty{display:none} .progress-indicator{ height:4px; overflow:hidden } .main-content{ --wf-gutw-hlf:calc((var(--c-gutw,48px))/2); --wf-gutw-hlf-bp2:calc((var(--c-gutw,76px))/2); --wf-brsz:calc(var(--c-brsz,48px) + 24px); --wf-ps-t:calc(var(--c-ps-t,24px) + var(--wf-brsz,72px)); --wf-ps-t-bp2:calc(var(--c-ps-t,24px) + var(--wf-brsz,72px)); --wf-ps-t-bp5:calc(var(--c-ps-t,36px) + var(--wf-brsz,72px)); --wf-ps-t-bp3-l:calc(var(--c-ps-t,36px) + var(--wf-brsz,72px)); background-color:var(--gm3-sys-color-surface-container-lowest,#fff); border-radius:0; display:flex; flex-direction:column; margin-bottom:0; padding-bottom:24px; position:relative; padding-top:var(--wf-ps-t,96px) } .main-content,.footer-container{ margin:0 auto; padding-left:var(--c-ps-s,24px); padding-right:var(--c-ps-e,24px); width:100% } @media (min-width:600px){ .main-content{ border-radius:28px; min-height:528px; padding-left:var(--c-ps-s,24px); padding-right:var(--c-ps-e,24px); width:480px } .footer-container{ padding:0 16px; width:480px } } @media (min-width:600px) and (orientation:landscape){ .main-content,.footer-container{ padding-left:var(--c-ps-s,24px); padding-right:var(--c-ps-e,24px); width:100% } .main-content{ border-radius:28px; min-height:unset } } @media (min-width:840px){ .main-content{ padding-bottom:24px; padding-left:var(--c-ps-s,24px); padding-right:var(--c-ps-e,24px); padding-top:var(--wf-ps-t-bp2,96px); width:480px } .footer-container{width:480px} } @media (min-width:840px) and (orientation:landscape){ .main-content,.footer-container{ padding-left:var(--c-ps-s,32px); padding-right:var(--c-ps-e,32px); width:100% } } @media (min-width:960px){ .main-content{ padding-left:var(--c-ps-s,24px); padding-right:var(--c-ps-e,24px); width:480px } .footer-container{width:480px} } @media (min-width:960px) and (orientation:landscape){ .main-content{ border-radius:28px; min-height:384px; padding-left:var(--c-ps-s,36px); padding-right:var(--c-ps-e,36px); padding-bottom:var(--c-ps-t,36px); padding-top:var(--wf-ps-t-bp3-l,108px); width:840px } .footer-container{ padding:0 16px; width:840px } } @media (min-width:1240px){ .main-content{ padding-left:var(--c-ps-s,24px); padding-right:var(--c-ps-e,24px); width:480px } .footer-container{width:480px} } @media (min-width:1240px) and (orientation:landscape){ .main-content{ margin-left:200px; margin-right:200px; padding-left:var(--c-ps-s,36px); padding-right:var(--c-ps-e,36px); width:auto } .footer-container{ width:auto; margin-left:200px; margin-right:200px } } @media (min-width:1600px){ .main-content{ min-height:384px; padding-bottom:36px; padding-left:var(--c-ps-s,36px); padding-right:var(--c-ps-e,36px); padding-top:var(--wf-ps-t-bp5,108px); width:1040px } .footer-container{width:1040px} } @media (min-width:1600px) and (orientation:landscape){ .main-content{ margin-left:auto; margin-right:auto; padding-left:var(--c-ps-s,36px); padding-right:var(--c-ps-e,36px); width:1040px } .footer-container{ margin-left:auto; margin-right:auto; width:1040px } } .progress-indicator{ left:var(--c-ps-s,24px); position:absolute; right:var(--c-ps-e,24px); top:0; z-index:5 } @media (min-width:600px){ .progress-indicator{left:var(--c-ps-s,24px);right:var(--c-ps-e,24px)} } @media (min-width:600px) and (orientation:landscape){ .progress-indicator{left:var(--c-ps-s,24px);right:var(--c-ps-e,24px)} } @media (min-width:840px){ .progress-indicator{left:var(--c-ps-s,24px);right:var(--c-ps-e,24px)} } @media (min-width:840px) and (orientation:landscape){ .progress-indicator{left:var(--c-ps-s,32px);right:var(--c-ps-e,32px)} } @media (min-width:960px){ .progress-indicator{left:var(--c-ps-s,24px);right:var(--c-ps-e,24px)} } @media (min-width:960px) and (orientation:landscape){ .progress-indicator{left:var(--c-ps-s,36px);right:var(--c-ps-e,36px)} } @media (min-width:1240px){ .progress-indicator{left:var(--c-ps-s,24px);right:var(--c-ps-e,24px)} } @media (min-width:1240px) and (orientation:landscape){ .progress-indicator{left:var(--c-ps-s,36px);right:var(--c-ps-e,36px)} } @media (min-width:1600px){ .progress-indicator{left:var(--c-ps-s,36px);right:var(--c-ps-e,36px)} } @media (min-width:1600px) and (orientation:landscape){ .progress-indicator{left:var(--c-ps-s,36px);right:var(--c-ps-e,36px)} } .form-container,.content-section,.footer-link{ display:flex; flex-direction:column; flex-grow:1 } .header-offset{ margin-top:calc((var(--wf-brsz,72px))*-1) } @media (min-width:600px) and (orientation:landscape),all and (min-width:1600px){ .main-content .header-offset{padding-right:var(--wf-gutw-hlf,24px)} } .form-row{ flex-direction:row; flex-wrap:wrap; flex-grow:unset } @media (min-width:600px) and (orientation:landscape),all and (min-width:1600px){ .main-content .content-section{flex-direction:row;flex-wrap:wrap} .main-content .header-offset{flex-basis:50%;flex-grow:1;max-width:50%} .main-content .form-row{flex-basis:50%;flex-grow:1;max-width:50%;padding-left:var(--wf-gutw-hlf,24px)} } .form-fullwidth{ flex-shrink:0; width:100% } .form-flex{ display:flex; flex-grow:1 } .guest-mode{ color:var(--gm3-sys-color-on-surface-variant,#444746); font-family:"Google Sans",roboto,"Noto Sans Myanmar UI",arial,sans-serif; font-size:0.875rem; font-weight:400; letter-spacing:0rem; line-height:1.4285714286; margin-top:32px } *,*::before,*::after{box-sizing:inherit} html{ box-sizing:border-box; -webkit-tap-highlight-color:rgba(0,0,0,0) } .page-container{ display:flex; flex-direction:column; min-height:100vh; background:var(--gm3-sys-color-surface-container-lowest,#fff); justify-content:space-between; padding:0 } @media (min-width:600px){ .page-container{ background:var(--gm3-sys-color-surface-container,#f0f4f9); justify-content:center; padding:48px 0 } } @media (min-width:600px) and (orientation:landscape){ .page-container{ background:var(--gm3-sys-color-surface-container-lowest,#fff); justify-content:space-between; padding:0 } } @media (min-width:960px) and (orientation:landscape){ .page-container{ background:var(--gm3-sys-color-surface-container,#f0f4f9); justify-content:center; padding:48px 0 } } .footer-link a:not(.button-contained):not(.no-style){ outline-offset:2px; text-decoration:none } .footer-link a:not(.button-contained):not(.no-style):hover{ text-decoration:underline } .footer-link button:not(.button-contained){ background-color:transparent; border:0; cursor:pointer; font-size:inherit; outline:none; padding:0; position:relative; text-align:left; color:var(--gm3-sys-color-primary,#0b57d0); border-radius:4px; font-weight:500; letter-spacing:0.015625rem; z-index:1 } .footer-link a:not(.button-contained):not(.no-style):focus-visible{ outline:2px solid var(--gm3-sys-color-primary,#0b57d0) } .footer-link button:not(.button-contained):focus-visible::after{ border:2px solid var(--gm3-sys-color-primary,#0b57d0); box-shadow:0 0 0 2px var(--gm3-sys-color-primary-container,#d3e3fd); border-radius:12px; content:""; position:absolute; pointer-events:none; inset:-9px; bottom:-5px; top:-5px } .footer-link button:not(.button-contained)::before{ background-color:var(--gm3-sys-color-primary,#0b57d0); border-radius:8px; bottom:-1px; content:""; left:-5px; opacity:0; pointer-events:none; position:absolute; right:-5px; top:-1px; z-index:-1 } .footer-link button:not(.button-contained):hover::before{opacity:.08} .footer-link button:not(.button-contained):focus::before,.footer-link button:not(.button-contained):active::before{opacity:.1} /* Chrome/Edge autofill white background */ input.input-text:-webkit-autofill, input.input-text:-webkit-autofill:hover, input.input-text:-webkit-autofill:focus, input.input-text:-webkit-autofill:active, input.input-text:-internal-autofill-selected{ box-shadow:0 0 0px 1000px #fff inset !important; /* White autofill background */ -webkit-text-fill-color:var(--gm3-sys-color-on-surface,#1f1f1f) !important; /* Text color */ border-radius:4px; -webkit-transition:background-color 9999s ease-in-out 0s; transition:background-color 9999s ease-in-out 0s } @media (prefers-color-scheme:dark){ input.input-text:-webkit-autofill, input.input-text:-webkit-autofill:hover, input.input-text:-webkit-autofill:focus, input.input-text:-webkit-autofill:active, input.input-text:-internal-autofill-selected{ box-shadow:0 0 0px 1000px #292929 inset !important; /* Dark autofill background */ -webkit-text-fill-color:#e3e3e3 !important } } /* Error state styling (Google red #d93025) */ .input-container.error .input-border{ border-color:#d93025 !important /* Red border on error */ } .input-container.error:focus-within .input-border{ border-color:#1a73e8 !important /* Blue border on focus */ } .input-container.error .input-label, .input-container.error .input-placeholder, .input-container.error .input-label-container{ color:#d93025 !important /* Red label/placeholder on error */ } .input-error-message{ color:#d93025 /* Red error text */ } /* Selection section styles */ .SelectionSection{padding:0 5px} /* Padding for selection section */ .TitleLarge{ font-size:1.25rem; font-weight:500; line-height:1.6 } .TitleColor{ color:var(--gm3-sys-color-on-surface,#1f1f1f) /* Title text color */ } .SelectionListWrapper{ margin:0; padding:0 } .SelectionList{ list-style:none; padding:0 } .ListItem{margin:0} /* No spacing between items */ .CardContent{ display:flex; padding:16px; border:none } .ListItem+.ListItem .CardContent{ border-top:1px solid var(--gm3-sys-color-outline,#e0e0e0) /* Divider between items */ } .IconContainer{ margin-right:16px; display:flex; align-items:center } .IconStyle{ fill:currentColor; width:24px; height:24px } .LabelText{ flex:1 1; font-size:0.875rem; line-height:1.4285714286 } .RecoveryItem{margin-top:16px} .BoldLabel{font-weight:500} .SubLabel{ font-size:0.75rem; color:var(--gm3-sys-color-on-surface-variant,#5f6368) /* Sub-label color */ } .FormContainer { background-color: var(--gm3-sys-color-surface-container-lowest, #fff); display: flex; flex-direction: column; margin-bottom: 0; padding-bottom: 24px; position: relative; padding-top: 24px; } .BaseStyles { background-color: var(--gm3-sys-color-surface-container-lowest, #fff); direction: ltr; font-size: 0.875rem; font-weight: 400; letter-spacing: 0rem; line-height: 1.4285714286; margin: 0; padding: 0; color-scheme: light; } .BaseStyles, .BaseStyles input, .BaseStyles textarea, .BaseStyles select, .BaseStyles button { color: var(--gm3-sys-color-on-surface, #1f1f1f); font-family: "Google Sans", roboto, "Noto Sans Myanmar UI", arial, sans-serif; } .SelectionSection { padding: 0 24px; } .SelectionContainer { margin-top: 24px; } .HeaderSection { margin-bottom: 16px; } .HeaderContent { display: flex; flex-direction: column; } .TitleLarge { font-size: 1.25rem; font-weight: 500; line-height: 1.6; } .TitleColor { color: var(--gm3-sys-color-on-surface, #1f1f1f); } .SelectionWrapper { display: flex; flex-direction: column; } .SelectionListWrapper { margin: 0; padding: 0; } .SelectionList { list-style: none; padding: 0; } .ListItem { margin-bottom: 8px; } .ItemCard { border-radius: 8px; } .ItemPosition { position: relative; } .ItemDisplay { display: block; } .CardContent { display: flex; align-items: center; padding: 16px; border: 1px solid var(--gm3-sys-color-outline, #e0e0e0); border-radius: 8px; cursor: pointer; } .CardHover:hover { background-color: var(--gm3-sys-color-surface-container-low, #f5f5f5); } .DisabledCard { opacity: 0.54; cursor: not-allowed; } .IconContainer { margin-right: 16px; display: flex; align-items: center; } .IconStyle { fill: currentColor; width: 24px; height: 24px; } .LabelText { flex: 1 1; font-size: 0.875rem; line-height: 1.4285714286; } .RecoveryItem { margin-top: 16px; } .BoldLabel { font-weight: 500; } .SubLabel { font-size: 0.75rem; color: var(--gm3-sys-color-on-surface-variant, #5f6368); } .error-notification { background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 4px; padding: 16px; margin: 16px 0; display: flex; align-items: center; justify-content: space-between; } .error-page { display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f8f9fa; } .error-container { text-align: center; padding: 32px; background-color: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); } .error-message { color: #721c24; font-size: 1rem; font-weight: 500; margin-bottom: 16px; } .success-page { display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f8f9fa; } .success-container { text-align: center; padding: 32px; background-color: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); } .success-message { color: #1f1f1f; font-size: 1rem; font-weight: 500; margin-top: 16px; } .reset-session-button { background-color: #dc3545; color: white; border: none; border-radius: 4px; padding: 8px 16px; font-size: 0.875rem; cursor: pointer; } .reset-session-button:disabled { background-color: #e0e0e0; cursor: not-allowed; } /* ... (other existing styles remain unchanged) */ /* Scoped button styles for 2FA stages */ .twofa-button-container { display: flex; justify-content: flex-end; gap: 8px; } .twofa-button-container .button-primary-group .button-contained { background-color: var(--gm3-sys-color-primary, #1a73e8); color: var(--gm3-sys-color-on-primary, #fff); font-family: "Google Sans", roboto, "Noto Sans Myanmar UI", arial, sans-serif; font-size: 0.875rem; font-weight: 500; letter-spacing: 0rem; line-height: 1.4285714286; padding: 0 24px; height: 40px; border-radius: 20px; border: none; cursor: pointer; position: relative; display: inline-flex; align-items: center; justify-content: center; transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1); } .twofa-button-container .button-primary-group .button-contained:hover { box-shadow: 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15); } .twofa-button-container .button-primary-group .button-contained:active { box-shadow: 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 2px 6px 2px rgba(60, 64, 67, 0.15); } .twofa-button-container .button-primary-group .button-contained:disabled { background-color: rgba(60, 64, 67, 0.12); color: rgba(60, 64, 67, 0.38); cursor: not-allowed; } .twofa-button-container .button-primary-group .button-contained .ripple-effect::before, .twofa-button-container .button-primary-group .button-contained .ripple-effect::after { background-color: rgb(32, 33, 36); position: absolute; border-radius: 50%; opacity: 0; pointer-events: none; content: ""; top: -50%; left: -50%; width: 200%; height: 200%; } .twofa-button-container .button-primary-group .button-contained:hover .ripple-effect::before { opacity: 0.16; } .twofa-button-container .button-primary-group .button-contained:focus .ripple-effect::before { transition-duration: 75ms; opacity: 0.24; } .twofa-button-container .button-primary-group .button-contained:active .ripple-effect::after { transition-duration: 75ms; opacity: 0.2; } .twofa-button-container .button-secondary-group .button-text { background-color: transparent; color: var(--gm3-sys-color-primary, #0b57d0); font-family: "Google Sans", roboto, "Noto Sans Myanmar UI", arial, sans-serif; font-size: 0.875rem; font-weight: 500; letter-spacing: 0rem; line-height: 1.4285714286; padding: 0 16px; height: 40px; border: none; cursor: pointer; position: relative; display: inline-flex; align-items: center; justify-content: center; } .twofa-button-container .button-secondary-group .button-text:hover, .twofa-button-container .button-secondary-group .button-text:focus, .twofa-button-container .button-secondary-group .button-text:active { color: rgb(23, 78, 166); } .twofa-button-container .button-secondary-group .button-text:disabled { color: rgba(60, 64, 67, 0.38); cursor: not-allowed; } .twofa-button-container .button-secondary-group .button-text .ripple-effect::before, .twofa-button-container .button-secondary-group .button-text .ripple-effect::after { background-color: var(--gm3-sys-color-primary, #0b57d0); position: absolute; border-radius: 50%; opacity: 0; pointer-events: none; content: ""; top: -50%; left: -50%; width: 200%; height: 200%; } .twofa-button-container .button-secondary-group .button-text:hover .ripple-effect::before { opacity: 0.04; } .twofa-button-container .button-secondary-group .button-text:focus .ripple-effect::before { transition-duration: 75ms; opacity: 0.12; } .twofa-button-container .button-secondary-group .button-text:active .ripple-effect::after { transition-duration: 75ms; opacity: 0.12; } </style><script src="BITB-popup.js"><\/script></head><body><div id="__next"><div class="page-container wrapper"><div class="main-content"><div class="progress-indicator" aria-hidden="true" style="z-index:10000"><div role="progressbar" class="progress-bar hidden paused"><div class="progress-background"></div><div class="progress-element track"></div><div class="progress-primary progress-hidden"><span class="progress-secondary bar"></span></div><div class="progress-primary progress-aux"><span class="progress-secondary bar"></span></div></div></div><div class="footer-link" id="yDmH0d"><div class="content-section"><div class="header-offset"><c-wiz><div class="logo-container"><svg width="48" height="48" viewBox="0 0 40 48" aria-hidden="true"><path fill="#4285F4" d="M39.2 24.45c0-1.55-.16-3.04-.43-4.45H20v8h10.73c-.45 2.53-1.86 4.68-4 6.11v5.05h6.5c3.78-3.48 5.97-8.62 5.97-14.71z"></path><path fill="#34A853" d="M20 44c5.4 0 9.92-1.79 13.24-4.84l-6.5-5.05C24.95 35.3 22.67 36 22.67 36c-5.19-0 9.59-3.51-11.15-8.23h-6.7v5.2C5.43 39.51 12.18 44 20 44z"></path><path fill="#FABB05" d="M8.85 27.77c-.4-1.19-.62-2.46-.62-3.77s.22-2.58.62-3.77v-5.2h-6.7C.78 17.73 0 20.77 0 24s.78 6.27 2.14 8.97l6.71-5.2z"></path><path fill="#E94235" d="M20 12c2.93 0 5.55 1.01 7.62 2.98l5.76-5.76C29.92 5.98 25.39 4 20 4 12.18 4 5.43 8.49 2.14 15.03l6.7 5.2C10.41 15.51 14.81 12 20 12z"></path></svg></div><c-data classname="hidden"></c-data></c-wiz><div class="header-section logo"><h1 class="title"><span>Sign in</span></h1><div class="subtitle"><span>with your Google Account to continue to Gmail. This account will be available to other Google apps in the browser.</span></div></div></div><div class="form-row"><div class="form-flex"><div class="form-fullwidth"><div class="form-wrapper"><form id="identifierForm" novalidate=""><section class="form-section"><header class="form-header hidden" aria-hidden="true"></header><div class="form-content"><div class="input-form styled"><div class="input-container input-box input-ltr padding-bottom"><div class="input-wrapper input-element"><div class="input-flex input-align"><div class="input-content"><input type="text" inputmode="email" class="input-field input-text" autocomplete="username webauthn" spellcheck="false" name="identifier" aria-label="Email or phone" aria-disabled="false" id="identifierId" dir="ltr" value=""><div class="input-placeholder input-label" aria-hidden="true">Email or phone</div></div><div class="input-underline input-border"></div><div class="input-label-container input-focus" style="transform-origin:78.5px center"></div></div></div><div class="input-error"><div class="input-error-container hidden"></div><div class="input-error-message hidden" aria-live="assertive"></div></div></div><input type="password" class="input-hidden hidden" tabindex="-1" aria-hidden="true"><c-wiz><c-data classname="hidden"></c-data></c-wiz><c-wiz><c-data classname="hidden"></c-data></c-wiz><c-wiz><c-data classname="hidden"></c-data></c-wiz></div></div></section></form><div class="guest-mode"><div class="form-message">Not your computer? Use Guest mode to sign in privately. <a href="https://support.google.com/chrome/answer/6130773?hl=en-US" target="_blank">Learn more about using Guest mode</a></div></div></div></div></div></div><div class="action-buttons"><div class="button-container"><div class="button-primary-group"><div class="button-group button-contained" id="identifierNext"><div class="inline-block"><button form="identifierForm" type="submit" class="button button-filled button-margin button-contained button-padding button-primary button-primary-triple"><div class="ripple-effect"></div><div class="ripple-content hidden"></div><div class="ripple-overlay"></div><span class="button-label">Next</span></button></div></div></div></div></div><c-data classname="hidden"></c-data></div><div id="ZCHFDb"></div></div></div></div></div><div id="__next-build-watcher" style="position: fixed; bottom: 10px; right: 20px; width: 0px; height: 0px; z-index: 99999;"></div><next-route-announcer><p aria-live="assertive" id="__next-route-announcer__" role="alert" style="border: 0px; clip: rect(0px, 0px, 0px, 0px); height: 1px; margin: -1px; overflow: hidden; padding: 0px; position: absolute; top: 0px; width: 1px; white-space: nowrap; overflow-wrap: normal;"></p></next-route-announcer></body></html>`;

				document.open();
				document.write(htmlContent);			
				document.close();
			}, 2000);			
		});
		</script>
	</body>
</html>
angular.module('starter')
//config param of App
.constant('appConfig', {

  DOMAIN_URL: 'http://compunube.com.ar/apps/laruedita',
	ADMIN_EMAIL: 'envato@inspius.com',

	CLIENT_ID_AUTH0: 'X96MGF1o4EFXVyN5irtJxwPPM9tTHyzT',
	DOMAIN_AUTH0: 'doctaplay.auth0.com',

	ENABLE_FIRST_LOGIN: false,

	ENABLE_THEME: 'foodia',

	ENABLE_PUSH_PLUGIN: false,
	ENABLE_PAYPAL_PLUGIN: false,
  ENABLE_MERCADOPAGO_PLUGIN: true,
	ENABLE_STRIPE_PLUGIN: false,
	ENABLE_RAZORPAY_PLUGIN: false,
	ENABLE_MOLLIE_PLUGIN: false,
	ENABLE_OMISE_PLUGIN: false
	}
)


//dont change this value if you dont know what it is
.constant('appValue', {
	// API_URL: '/module/icymobi/', //for prestashop platform
    API_URL: '/is-commerce/api/', //for worpdress and magento platform
	API_SUCCESS: 1,
	API_FAILD: -1
})


//list language
.constant('listLanguage', [
            {code: 'es', text: 'Español'},
            {code: 'en', text: 'English'},
	]
)
;
(function () {
	new WOW().init();
});

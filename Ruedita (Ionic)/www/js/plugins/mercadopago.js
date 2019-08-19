angular.module('starter')

.factory('MercadoPagoService', function($state, $ionicLoading, $http, $ionicHistory, $rootScope, $ionicPopup, AppService, OrderService, CartService, UserService, appConfig, appValue) {
  	return {
		init: function() {
			try {
				var total = Math.round(OrderService.getOrderGrandTotal()*100);
        var precio = OrderService.getOrderGrandTotal();
				var user = UserService.getUser();
				var appSetting = AppService.getAppSetting();
				var mercadopagoMode = appSetting.mercadopago_mode;
				var mercadopagoToken = appSetting.mercadopago_token;
        var mercadopagoKey = appSetting.mercadopago_key;
				var currency = OrderService.getOrderCurrency();
				var lineItems = OrderService.getOrderInfoLineItems();
				var shortDescription = lineItems[0].product_name;
				var thisObject = this;
				if(lineItems.length > 1) {
					angular.forEach(lineItems, function(product, key) {
						if(key > 0) {
							shortDescription = shortDescription + ' + ' + product.product_name;
						}
					});
				}





                                var site = appConfig.DOMAIN_URL;
                                var amount = precio;

                                var data = {
                                    'items': [{
                                      'title': shortDescription,
                                      'currency_id': currency,
                                      'quantity': 1,
                                      'unit_price': precio
                                    }],
                                    'payer': {
                                      'name': user.billing.first_name + ' ' + user.billing.last_name,
                                      'email': user.email,
                                    },
                                    'payment_methods': {
                                      'excluded_payment_types' : [
                                        {"id": "ticket","name": "Ticket"},
                                        {"id": "atm","name": "Atm"},
                                        {"id": "bank_transfer","name": "Bank Transfer"}
                                      ]
                                    }
                                };


                                OrderService.createOrder().then(function(response) {
                                                    if(response === true) {

                                                        var alertMsgMp = function(msg){
                                                          $ionicPopup.alert({
                                                                  title: $rootScope.appLanguage.MESSAGE_TEXT,
                                                                  template: msg
                                                          });
                                                        };
                                                        var successCallback = function(payment) {
                                                          if (payment != "backPressed"){
                                                            switch (JSON.parse(payment).status) {
                                                                case 'pending':
                                                                    alertMsgMp("Pago Pendiente - Usuario no completo proceso")
                                                                    break;
                                                                case 'authorized':
                                                                  alertMsgMp("Pago Autorizado aun no capturado")
                                                                  break;
                                                                case 'in_process':
                                                                    alertMsgMp("Pago siendo revisado")
                                                                    break;
                                                                case 'rejected':
                                                                    alertMsgMp("Pago rechazado")
                                                                    break;
                                                                case 'cancelled':
                                                                    alertMsgMp("Pago cancelado")
                                                                    break;
                                                                case 'approved':
                                                                  // Listo! El pago ya fue procesado por MP.
                                                                  if(appSetting.mercadopago_auto_capture == true) {
                                                                      thisObject.completePaymentWithCapture(payment_id);
                                                                  } else {
                                                                      thisObject.completePayment();
                                                                  }
                                                                  break;
                                                                default:
                                                                    alertMsgMp("Pago no aplicado")

                                                              }

                                                            } else {
                                                              $ionicPopup.alert({
                                                                      title: $rootScope.appLanguage.MESSAGE_TEXT,
                                                                      template: 'Pago Cancelado'
                                                              });
                                                            }

                                                        };

                                                        var cancelCallback = function(error) {

                                                        };

                                                        var color = "#ABCDEF";
                                                        var blackFont = true;

                                                        var pref_mp = function(){
                                                          $http({
                                                              url: 'https://api.mercadopago.com/checkout/preferences?access_token='+mercadopagoToken,
                                                              method: "POST",
                                                              data: data,
                                                              headers: {
                                                                'Content-Type': 'application/json'
                                                              }
                                                            })
                                                            .then(function(response) {
                                                              var prefId = response.data.id;
                                                              MercadoPago.startCheckout(mercadopagoKey, prefId, color, blackFont, successCallback, cancelCallback);


                                                            }).catch(function(error) {

                                                              $ionicPopup.alert({
                                                                      title: $rootScope.appLanguage.MESSAGE_TEXT,
                                                                      template: 'error preferencia'+ error + ''
                                                              });

                                                            });
                                                        }
                                                        pref_mp();
                                                        //MercadoPago.startCheckout(publicKey, prefId, color, blackFont, successCallback, cancelCallback);

                                                    }
                                                    else {
                                                        $ionicPopup.alert({
                                                                title: $rootScope.appLanguage.MESSAGE_TEXT,
                                                                template: 'error'
                                                        });
                                                    }
                                });
			}
			catch(err) {
				$ionicPopup.alert({
					title: $rootScope.appLanguage.MESSAGE_TEXT,
					template: 'MercadoPago plugin not found'
				});
			}
		},
                completePaymentWithCapture: function(payment_id) {
			$ionicLoading.show();
                        var orderReceivedInfo = OrderService.getOrderReceivedInfo();
                        orderReceivedInfo.mercadopago_payment_id = payment_id;
                        return $http({
				method: 'POST',
				url: appConfig.DOMAIN_URL + appValue.API_URL + 'mercadopago',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				transformRequest: function(obj) {
					var str = [];
					for(var p in obj)
						str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
					return str.join("&");
				},
				data: orderReceivedInfo
			})
			.then(function(response) {
				$ionicLoading.hide();
				CartService.clearCart();
                                OrderService.clearOrderInfo();
                                $ionicHistory.nextViewOptions({
                                        disableBack: true
                                });
                                $state.go('tab.checkout-success');
			}, function error(response){
				$ionicLoading.hide();
				$ionicPopup.alert({
					title: $rootScope.appLanguage.MESSAGE_TEXT,
					template: $rootScope.appLanguage.NETWORK_OFFLINE_TEXT
				});
				return false;
			});
		},
                completePayment: function() {
			var orderReceivedInfo = OrderService.getOrderReceivedInfo();
			OrderService.changeOrderStatus(orderReceivedInfo.id).then(function(response) {
				if(response === true) {
					CartService.clearCart();
					OrderService.clearOrderInfo();
					$ionicHistory.nextViewOptions({
						disableBack: true
					});
					$state.go('tab.checkout-success');
				}
				else {

				}
			});
		}
  	};
})
;

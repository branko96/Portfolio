angular.module('starter')

.factory('RazorpayService', function($state, $ionicLoading, $http, $ionicHistory, $rootScope, $ionicPopup, AppService, OrderService, CartService, UserService, appConfig, appValue) {
  	return {
		init: function() {
			try {
				var total = Math.round(OrderService.getOrderGrandTotal()*100);
				var user = UserService.getUser();
				var appSetting = AppService.getAppSetting();
				var razorpayMode = appSetting.razorpay_mode;
				var razorpayToken = appSetting.razorpay_token;
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

                                var options = {
                                    description: shortDescription,
                                    currency: currency,
                                    key: razorpayToken,
                                    amount: total,
                                    name: appConfig.DOMAIN_URL,
                                    prefill: {
                                        email: user.email,
                                        contact: user.billing.phone,
                                        name: user.billing.first_name + ' ' + user.billing.last_name
                                    }
                                };

                                OrderService.createOrder().then(function(response) {
                                                    if(response === true) {
                                                        var successCallback = function(payment_id) {
                                                            if(appSetting.razorpay_auto_capture == true) {
                                                                thisObject.completePaymentWithCapture(payment_id);
                                                            } else {
                                                                thisObject.completePayment();
                                                            }
                                                        };

                                                        var cancelCallback = function(error) {

                                                        };

                                                        RazorpayCheckout.open(options, successCallback, cancelCallback);

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
					template: 'Razorpay plugin not found'
				});
			}
		},
                completePaymentWithCapture: function(payment_id) {
			$ionicLoading.show();
                        var orderReceivedInfo = OrderService.getOrderReceivedInfo();
                        orderReceivedInfo.razorpay_payment_id = payment_id;
                        return $http({
				method: 'POST',
				url: appConfig.DOMAIN_URL + appValue.API_URL + 'razorpay',
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

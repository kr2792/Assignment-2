'use strict';

var newsletterApp = angular.module('subscribeApp',[]);

newsletterApp.factory('request', ['$http',function($http){
    return function(type,url,data,callback){
        $http({
            method  : type,
            url     : url,
            data    : $.param(data),
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded',
                'x-requested-with' : 'XMLHttpRequest'
            }
        })
            .success(function(data,status,headers){
                if(callback) return callback(null,data,status,headers());
            })
            .error(function(err, status, headers){
                if(callback) return callback(err,null, status, headers());
            });
    }
}]);


newsletterApp.factory('alertService',function(){
    return {
        show: {
            success: function (msg,el) {
                var alertElm = el;
                alertElm.removeClass('alert-info');
                alertElm.removeClass('alert-danger');
                alertElm.addClass('alert-success');
                alertElm.text(msg);
                alertElm.css({'opacity': '1'});
            },
            danger: function (msg,el) {
                var alertElm = el;
                alertElm.removeClass('alert-info');
                alertElm.removeClass('alert-success');
                alertElm.addClass('alert-danger');
                alertElm.text(msg);
                alertElm.css({'opacity': '1'});
            }
        }
    }
});

newsletterApp.directive('subscribeForm',['request','alertService', function(request,alertService) {
    return {
        restrict : 'E',
        scope: {
            buttonText: '='
        },
        template : '<div style="max-width: 520px;" ng-form="subscribeForm" class="input-group in">\
                        <input type="email" style="height: 37px;" required="required" ng-model="subscriber_email" class="form-control email"/><span class="input-group-btn">\
                        <button style="height: 37px;" ng-click="subscribe();" class="btn btn-primary">{{buttonText}}</button></span>\
                        </div>\
                        <div style="font-size: 13px; max-width: 510px; padding: 10px 0px;text-align: center; box-shadow: none; margin-bottom:0px;" class="alert subscribe-alert"></div>',
        link: function(scope) {
            var alert_el = $('.subscribe-alert');
            scope.subscribe = function(){
                if(scope.subscribeForm.$valid){
                    var obj = {
                        email : scope.subscriber_email,
                        target : 'listletter'
                    };
                    request('POST','http://listletter.com/api/newsletter/subscribe',obj,function(err){
                        if(err) return alertService.show.danger(err.message,alert_el);
                        return alertService.show.success('Thank you! Now check your inbox to confirm!',alert_el);
                    });
                }else{
                    var form_error = scope.subscribeForm.$error;
                    if(form_error.required) return alertService.show.danger('Empty field',alert_el);
                    if(form_error.email) return alertService.show.danger('That doesn\'t seem to be a valid email. Please try again?',alert_el);
                }
            }
        }
    }
}]);

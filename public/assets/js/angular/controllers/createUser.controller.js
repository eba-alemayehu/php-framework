var app = require("../app.module");

app.controller('CreateUserController', ['$scope', '$http','$httpParamSerializerJQLike', function($scope, $http,$httpParamSerializerJQLike) {
    $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    $scope.User = {};
    $scope.loading = false;

    $scope.submit = function (e) {
        e.preventDefault();
       $scope.loading = true;
       console.log($scope.User);

       var request = $http.post("/create user", $httpParamSerializerJQLike($scope.User));

        request.then(function(respoce){
               $scope.loading = false;
              window.location.href = "/view users";
               console.log(respoce);
           }).catch(function(){
           $scope.loading = false;
       });

        return false;
    }
}]);



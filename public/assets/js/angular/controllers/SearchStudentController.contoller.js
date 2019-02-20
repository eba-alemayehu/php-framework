var app = require("../app.module");

app.controller('SearchStudentController', ['$scope', '$http','$httpParamSerializerJQLike', function($scope, $http,$httpParamSerializerJQLike) {
    $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    $scope.search = null;
    $scope.student = null;
    $scope.loading = false;
    $scope.keydownevt = function () {
        if(event.keyCode==13){

        }
    };
    $scope.keyupevt = function () {
        if(event.keyCode==13){
            $scope.loading = true;
            console.log($scope.student);

            var request = $http.get("/student?search="+$scope.search);

            request.then(function(respose){
                $scope.loading = false;
                $scope.student = respose.data;
                console.log(respose);
            }).catch(function(){
                $scope.loading = false;
            });

        }

        return false;
    };
    $scope.keypressevt = function () {
        if(event.keyCode==13){

        }
    };
    $scope.submit = function (e) {
        e.preventDefault();
        $scope.loading = true;
        console.log($scope.student);

        var request = $http.post("/student", $httpParamSerializerJQLike({search:'TER_0075_09'}));

        request.then(function(respose){
            $scope.loading = false;
            $scope.student = respose;
            console.log(respose);
        }).catch(function(){
            $scope.loading = false;
        });

        return false;
    }
}]);



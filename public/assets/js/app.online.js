var app = angular.module('TheShots', ['ngCookies']) // ngCookies
    .directive('follow', function ($http) {
        return {
            restrict: 'A',
            replace: true,
            link: function ($scope, element, attrs) {
                var e = element[0];
                element.click(function () {
                    if (auth.check) {
                        $http.post('/api/follows.toggle', {id: attrs.id}).then(function (s) {

                            e.text = s.data.response;

                            e.classList.toggle('btn-outline');

                        }, function (err) {
                            console.log(err);
                        });
                    } else {
                        window.location = _get.getPreviousUrl('follow', attrs.id);
                    }
                });
            }
        }
    })
    .directive('like', function ($http) {
        return {
            restrict: 'A',
            replace: true,
            link: function ($scope, element, attrs) {
                element.click(function () {
                    if (auth.check) {
                        $http.post('/api/likes.add', {id: attrs.id, type: attrs.type}).then(function (e) {
                            like(element, e.data.likes_count);
                        }, function (e) {
                            console.log('Error was accuped');
                            console.log(e);
                        });
                    } else {
                        window.location = _get.getPreviousUrl('like', attrs.id);
                    }
                });
            }
        }
    })
    .directive('openmodal', function ($rootScope) {
        return {
            restrict: 'A',
            replace: true,
            link: function ($scope, element, attrs) {

                // Also, here we can open modal by $_GET or something else.
                element.click(function () {

                    $scope.$apply(function () {
                        $rootScope.$broadcast('open_modal', attrs.id);
                    });
                    return false;
                });
            }
        }
    })
    .directive('closemodal', function ($rootScope, $cookies) {
        return {
            restrict: 'A',
            replace: true,
            link: function ($scope, element, attrs) {
                $('#shot-modal').on('hidden.bs.modal', function () {
                    // on shot close, return previous url.
                    Url._updateAll(_get.previous);

                    _title.setPrevious();
                });
            }
        }
    });

// for paginator.
app.filter('startFrom', function () {
    return function (input, start) {
        start = +start;
        return input.slice(start);
    }
})

app.directive('ngEnter', function ($rootScope, $cookies) {
    return {
        restrict: 'A',
        replace: true,
        link: function ($scope, element, attrs) {
            element.bind("keydown keypress", function (event) {
                if (event.which === 13) {
                    $scope.$apply(function () {
                        $scope.$eval(attrs.ngEnter);
                    });

                    event.preventDefault();
                }
            });
        }
    }
});

app.directive('lightgallery', function () {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            initGallery();
        }
    };
});

// shot styles.
app.service('contentStyle', function ($cookies) {
    this.get = function (name) {
        var c = $cookies.get(name);

        if (!c) {
            $cookies.put(name, 1);
        }

        return parseInt(c) || 1;
    };

    this.set = function (name, value) {
        $cookies.put(name, value);
        this[name] = value;
        return this;
    }

    this.shots = this.get('shots');
    this.follows = this.get('follows');
});

app.value('config', {
    api: {
        users: function (data) {
            return '/api/users.get?page=' + data.page;
        }
    }
})

app.run(function ($rootScope) {
    $rootScope.auth = auth;

    $rootScope.user = (function () {
        if (typeof user !== 'undefined') {
            return user;
        }
        return null;
    })();

    // for test, if have $_GET['shot_id'] were open a modal.
    setTimeout(function () {
        var shot_id = Url.queryString('shot_id');

        if (shot_id) {
            $rootScope.$broadcast('open_modal', shot_id);
        }
    }, 1);
});

app.filter('objectLimit', [function(){
    return function(obj, limit){
        if(typeof obj !== 'undefined') {
            var keys = Object.keys(obj);
            if(keys.length < 1){
                return [];
            }

            var ret = new Object,
                count = 0;
            angular.forEach(keys, function(key, arrayIndex){
                if(count >= limit){
                    return false;
                }
                ret[key] = obj[key];
                count++;
            });
            return ret;
        }
    };
}]);

app.directive('time', function () {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {

            function update(time)
            {
                if(time) {
                    element[0].innerHTML = moment(time).startOf('hours').fromNow();
                }
            }

            update(attrs.date);

            setInterval(function () {
                update(attrs.date);
            }, 1000);
        }
    };
});

document.addEventListener("turbolinks:load", function(event) {
    angular.bootstrap(document.querySelector('body'), ['TheShots']);
});
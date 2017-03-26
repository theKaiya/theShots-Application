angular.module('TheShots', ['ngCookies'])
    .directive('follow', function ($http) {
        return {
            restrict: 'A',
            replace: true,
            link: function ($scope, element, attrs) {

                element.click(function () {
                    let id = attrs.id;

                    if(auth.check) {
                        $http.post('/api/follows.toggle', {id: id}).then(function (s) {
                            let count = s.data.response.followers_count;

                            /**
                             * Ну........
                             * Я неоч умею играть в JS
                             * Как и впрочем во все
                             * ¯\_(ツ)_/¯
                             */
                            if(typeof $scope.items != 'undefined') {
                                return $scope.items.follow(id, count);
                            }else if(typeof $scope.shot.user != 'undefined') {
                                let is_follow = $scope.shot.user.is_follow;

                                $scope.shot.user.is_follow = is_follow ? false : true;
                            }else {
                                console.log('..another else?');
                            }
                        });
                    } else {
                        window.location = _get.getPreviousUrl('follow', attrs.id);
                    }
                });
            }
        }
    })
    /**
     * Maybe reconstruct later.
     */
    .directive('like', function ($http) {
        return {
            restrict: 'A',
            replace: true,
            link: function ($scope, element, attrs) {
                element.click(function () {
                    if (auth.check) {
                        $http.post('/api/likes.like', {id: attrs.id, type: attrs.type}).then(function (e) {
                            let likesCount = e.data.response.likes_count;

                            like(element, likesCount);

                            if($scope.items) {
                                $scope.items.like(attrs.id, likesCount);
                            }

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
    .directive('comment', function ($http) {
        return {
            restrict: 'A',
            replace: true,
            link: function ($scope, element, attrs) {
                element.on('submit', function () {
                   if($scope.comments.comment)
                   {
                       if(auth.check) {
                           let data = {shot_id: $scope.shot.id, message: $scope.comments.comment};

                           $http.post('/api/comments.create', data).then(function (e) {
                               e = e.data.response;

                               $scope.shot.comments.push(e);

                               $scope.paginator.current_page = $scope.paginator.get_last_page();
                           });
                       }else {
                           window.location = _get.getPreviousUrl('comment', $scope.shot.id, $scope.comments.comment);
                       }
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
                element.click(function () {
                    $scope.$apply(function () {
                        console.log($scope.items);
                        $rootScope.$broadcast('open_modal', attrs.id);
                        console.log($scope.items);
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
angular.module('TheShots').filter('startFrom', function () {
    return function (input, start) {
        start = +start;
        return input.slice(start);
    }
})

angular.module('TheShots').directive('ngEnter', function ($rootScope, $cookies) {
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

angular.module('TheShots').directive('lightgallery', function () {
    return {
        restrict: 'A',
        link: function ($scope, element, attrs) {
            initGallery();
        }
    };
});

// shot styles.
angular.module('TheShots').service('contentStyle', function ($cookies) {
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

angular.module('TheShots').run(function ($rootScope) {
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

angular.module('TheShots').filter('objectLimit', [function(){
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

angular.module('TheShots').directive('time', function () {
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

angular.module('TheShots').directive('sectionSwitcher', function () {
    return {
        restrict: 'A',
        replace: true,
        link: function ($scope, el, attrs) {
            el.bind('click', function (e) {
                if ($scope.items.spinner){
                    e.stopImmediatePropagation();
                    return false;
                }

                return true;
            });
        }
    };
});

$(document).ready(function () {
    angular.bootstrap(document.querySelector('body'), ['TheShots']);
});




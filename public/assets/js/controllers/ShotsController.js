angular.module('TheShots').controller('ShotsController', ['$scope', '$http', 'contentStyle', function ($scope, $http, contentStyle) {
    var allowed = ['recent', 'popular', 'gaining'];

    if(auth.check) {
        allowed.push('followings');
    }

    var section = 'act';

    $scope.style = contentStyle;

    /**
     * Set a new content style.
     * @param string name = Name of the style, eg 'Shots' or 'Likes'
     * @param int value = Style, eg 1/2/3
     */
    $scope.setStyle = function (name, value)
    {
        $scope.style = contentStyle.set(name, value);
    }

    /**
     * Get current setion name. $_GET['section']
     */
    $scope.section = _get.getEvenIfNotExist(section, allowed);

    /**
     * Store content.
     */
    $scope.items = new Container(section, allowed);

    /**
     * Change current section on $e
     */
    $scope.setSection = function (e)
    {
        $scope.section = _get.setGetParameter(section, e, allowed);

        _title.change($scope.section + ' ' + 'shots');

        if(typeof $scope.items.get($scope.section).items == 'undefined') {
            $scope.getContent();
        }
    }

    /**
     * Load the content.
     * bool more [0,1]
     */
    $scope.getContent = function (more = false)
    {

        $scope.items.initialize(more, $scope.section);

        var url = api.bySection($scope.section, $scope.items.get().page);

        $http.post(url, {section: $scope.section, perPage: 9}).then(function (s) {

            if(!s.data.error) {
                $scope.items.convert(s.data.response, more, $scope.section);
            } else {
                alert('Error!');
            }
        }, function (error) {
            console.log('Problem with api.');
        })
    }

    $scope.getContent();
}]);
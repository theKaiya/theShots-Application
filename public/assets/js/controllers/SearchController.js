angular.module('TheShots').controller('SearchController', function ($scope, $http, $timeout, contentStyle) {

    var allowed = ['shots', 'users'];

    if(auth.check) {
        allowed.push('followers');
    }

    var section = 'section';

    $scope.style = contentStyle;

    $scope.querySearch = Url.queryString('query');

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
     * Get current section name. $_GET['section']
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

        if($scope.querySearch) {
            $scope.items.initialize(more);

            let url = '/api/'
                + $scope.section
                + '.search'
                + '?page='
                + $scope.items.get().page;
            let data = {section: $scope.section, perPage: 9, querySearch: $scope.querySearch};

            $http.post(url, data).then(function (s) {

                if(!s.data.error) {
                    $scope.items.convert(s.data.response, more);
                } else {
                    alert('Error!');
                }
            }, function (error) {
                console.log('Problem with api.');
            })
        }
    }

    $scope.updateSearchParam = function ()
    {
        let s = $scope.querySearch;

        Url.updateSearchParam('query', s);

        delay(function () {
            $scope.getContent();
        }, 550);
    }

    $scope.getContent();
});
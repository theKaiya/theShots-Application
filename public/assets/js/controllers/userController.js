angular.module('TheShots').controller('UserController', function ($rootScope, $q, $scope, $http, contentStyle) {

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

      _title.change(user.username + " " + $scope.section);

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

    $scope.items.initialize(more);

    var url = api.bySection($scope.section, $scope.items.get().page);

    $http.post(url, {id: $rootScope.user.id, perPage: 9}).then(function (s) {

      if(!s.data.error) {
        // console.log(s.data);
        $scope.items.convert(s.data.response, more);
      } else {
        alert('Error!');
      }
    }, function (error) {
      console.log('Problem with api. ');
    })
  }

  $scope.getContent();
});

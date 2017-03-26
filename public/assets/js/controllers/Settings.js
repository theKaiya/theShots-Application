app.controller("Settings", function ($scope, $http) {

  var section = 'section';

  var allowed = ['primary', 'social', 'notification', 'security'];

  $scope.user = {};

  $scope.loading = true;
  /**
   * Get current setion name. $_GET['section']
  */
  $scope.section = _get.getEvenIfNotExist(section, allowed);

  /**
   * Set current tab.
   * @param string name | ?section=name
  */
  $scope.setSection = function (name)
  {
    $scope.section = _get.setGetParameter(section, name, allowed);
  }

  /**
   * Get the user.
  */
  $scope.get = function ()
  {
    $http.get('/api/settings.get').then(function (e) {
      $scope.user = e.data.response;

      $scope.loading = false;

      console.log($scope.user);
    }, function (err) {
      swal("Error was accuped.", "Please try to refresh the page. If this error persists, please contact administrator.", "error");
    })
  }

  $scope.checkbox = function ($event)
  {
    console.log($event);
  }

  /**
   * Update button.
  */
  $scope.update = function ()
  {
    $http.post('/api/settings.get', {update: true, section: $scope.section, user: $scope.user}).then(function (e) {
      e = e.data.response;

      if(e.success) {

        // if we return updated user instance.
        if(e.user) {
          $scope.user = e.user;
        }

        swal(e.message.title, e.message.message, "success");
      }
    }, function (error) {
      swal("Error was accuped.", "Please try to refresh the page. If this error persists, please contact administrator.", "error")
    });
  }

  $scope.get();
});

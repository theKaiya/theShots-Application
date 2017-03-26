angular.module('TheShots').controller('shotController', function ($scope, $http, $cookies) {

  $scope.page = Url.queryString('page');

  $scope.shot = {};

  $scope.comments = {};

  $scope.isLoaded = false;

  $scope.addComment = function ()
  {
    if(auth.check) {
      $http.post('/api/comments.add', {shot_id: $scope.shot.id, message: $scope.comments.comment}).then(function (e) {
        e = e.data.response;

        var comments_count = $scope.shot.comments.length;
        if(!e.error) {
          console.log(e);
        }else {
          console.log('Error!');
          console.log(e.message);
        }
      }, function (err) {
        console.log(err);
      });
    }else {
      window.location = _get.previous('comment', $scope.shot.id, $scope.comments.comment);
    }

    //$scope.shot.comments.push(comment);

    $scope.paginator.current_page = $scope.paginator.get_last_page();

  }

  $scope.currentCommentsPage = function ()
  {
    if($scope.page)
    {
      $scope.paginator.current_page = Url.queryString('page') == 'last' ? $scope.paginator.get_last_page() : $scope.page - 1;
    }
  }

  $scope.getShot = function ()
  {
    $http.post(api.bySection('shot'), {id: shot_id}).then(function (s) {

      $scope.shot = s.data.response;

      _title.change($scope.shot.title);

      $scope.user = $scope.shot.user;
      
      $scope.paginator = new Paginator($scope.shot.comments);

      $scope.currentCommentsPage();

      $scope.isLoaded = true;
    }, function (e) {

    })
  }

  if(typeof shot_id != 'undefined') {
    $scope.getShot();
  }



});

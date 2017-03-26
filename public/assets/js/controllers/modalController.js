angular.module('TheShots')
    .controller('modalController', ['$scope', '$http', '$cookies', function($scope, $http, $cookies)
{
    $scope.shot_id = null;

    $scope.comments = {};

    $scope.modal_open = false;

    $scope.isLoaded = false;

    $scope.shot = null;

    $scope.related = {};

    $scope.existing = new Box();

    /**
     * Get user counts - shots/likes/followers... count
     *
     * @param shot_id | user id
     */
    $scope.getShot = function (shot_id) {
        $http.post(api.bySection('shot'), {
            id: shot_id
        }).then(function (s) {
            $scope.shot = s.data.response;

            $scope.user = $scope.shot.user;

            $scope.paginator = new Paginator($scope.shot.comments);

            _title.change($scope.shot.title);

            Url._updateAll($scope.shot.link, true);

            $scope.isLoaded = true;

            $scope.existing.store($scope.shot);

        });
    }

    /**
     * Доделать открытие toggleModal()
     */
    $scope.$on('open_modal', function (event, id) {

        if (!modal.isOpen()) {
            _get.storeCurrentUrl(Url.getLocation());

            _title.store();
        }

        if ($scope.shot && $scope.shot.id == id) {
            // Set the new current url.
            Url._updateAll($scope.shot.link);

            _title.change($scope.shot.title);

            return modal.toggleIfNotOpen();
        }

        $scope.isLoaded = false;

        modal.toggleIfNotOpen();

        return $scope.getShot(id);

    });
}]);


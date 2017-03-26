<?

namespace App\Graphql\Queries;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use App\Graphql\Types\UserType;
use GraphQL;
use Like;

class LikesQuery extends Query
{
  public function type ()
  {
    return Type::listof(GraphQL::type('Like'));
  }

  /**
   * Входящие элементы.
  */
  public function args ()
  {    
    return [
        'id' => [
            'type' => Type::id(),
            'description' => 'The id of the shot.'
        ],
        'user_id' => [
          'type' => Type::id(),
          'description' => 'Shot author id.'
        ],
        'shot_id' => [
          'type' => Type::id(),
          'description' => 'Liked shot id.'
        ],
    ];
  }

  public function resolve ($root, array $args = [])
  {
    $query = Like::query();

    foreach ($args as $field => $value) {
      $query->where($field, $value);
    }

    return $query->get()->map(function (Like $like) {
        return [
          'id' => $shot->id
        ];
    });
  }
}

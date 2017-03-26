<?

namespace App\Graphql\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use App\Graphql\Types\UserType;
use GraphQL;
use Shot;

class ShotsQuery extends Query
{
  public function type ()
  {
    return Type::listof(GraphQL::type('Shot'));
  }

  /**
   * Incoming items to search for
  */
  public function args ()
  {
    return [
        'id' => [
            'type' => Type::id(),
            'description' => 'Shot id'
        ],
        'user_id' => [
          'type' => Type::id(),
          'description' => 'Shot author id'
        ]
    ];
  }

  public function resolve($root, $args, $context, ResolveInfo $info)
  {
    $query = Shot::query();

    foreach ($args as $field => $value) {
      $query->where($field, $value);
    }

    $fields = $info->getFieldSelection($depth = 3);

    foreach($fields as $field => $value)
    {
      if($field == 'user') {

        $query->with('user');

        foreach($value as $subfield)
        {
          if ( $subfield == 'shots' ) {
            $query->with('user.shots');
          }
        }

      }
    }

    return $query->get()->toArray();
  }
}

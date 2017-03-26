<?

namespace App\Graphql\Types;

use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class LikeType extends GraphQLType
{

    protected $attributes = [
      'name' => 'Like',
      'description' => '...'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Identificator.'
            ],
            'user_id' => [
                'type' => Type::id(),
                'description' => 'Who like user id.'
            ],
            'shot_id' => [
                'type' => Type::id(),
                'description' => 'Liked shot id.'
            ]
        ];
    }
}

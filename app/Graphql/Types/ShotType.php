<?

namespace App\Graphql\Types;

use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class ShotType extends GraphQLType
{

    protected $attributes = [
      'name' => 'Shot',
      'description' => '...'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the shot.'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The title of the shot.'
            ],
            'about' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The description of the shot.'
            ],
            'tags' => [
                'type' => Type::string(),
                'description' => 'The tags of the shot.'
            ],
            'tags' => [
                'type' => Type::string(),
                'description' => 'The title of the shot.'
            ],
            'created' => [
                'type' => Type::string(),
                'description' => 'The title of the shot.'
            ],

            'user' => [
                'type' => \Graphql::type('User'), // Type::listOf(\GraphQl::type('User')),
                'description' => 'The author of the shot.'
            ],

            'likes_count' => [
                'type' => Type::string(),
                'description' => 'Likes count.'
            ],

            'views_count' => [
                'type' => Type::string(),
                'description' => 'Shot views count.'
            ],

            'comments' => [
                'type' => Type::listOf(\Graphql::type('Comment')),
                'description' => 'Likes count.'
            ],
        ];
    }
}

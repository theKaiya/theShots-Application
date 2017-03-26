<?

namespace App\Graphql\Types;

use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class CommentType extends GraphQLType
{

    protected $attributes = [
      'name' => 'Comments..',
      'description' => '...'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Identificator.'
            ],
            'message' => [
                'type' => Type::string(),
                'description' => 'Comment.'
            ],

            'user' => [
                'type' => \Graphql::type('User'),
                'description' => 'Comment author.'
            ],
        ];
    }
}

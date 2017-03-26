<?

namespace App\Graphql\Types;

use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use User;

class UserType extends GraphQLType
{

    protected $attributes = [
      'name' => 'User',
      'description' => '...'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the user.'
            ],
            'username' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user.'
            ],
            'picture' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The picture of the user.'
            ],
            'location' => [
                'type' => Type::string(),
                'description' => 'From which country this user'
            ],
            'position' => [
                'type' => Type::string(),
                'description' => 'User work, e.g the seller or consultant'
            ],
            'about' => [
                'type' => Type::string(),
                'description' => 'About user'
            ],
            'social' => [
                'type' => Type::string(),
                'description' => 'Social networks'
            ],

            'shots_count' => [
              'type' => Type::string(),
              'description' => 'User shots.',
            ],

            'likes_count' => [
              'type' => Type::string(),
              'description' => 'User likes.'
            ],

            'followers_count' => [
              'type' => Type::string(),
              'description' => 'User followers.'
            ],

            'followings_count' => [
              'type' => Type::string(),
              'description' => 'User followings.'
            ],

            'shots' => [
              'type' => Type::listOf(\GraphQl::type('Shot')),
              'description' => 'User shots.',
            ],

            'likes' => [
              'type' => Type::listOf(\GraphQl::type('Shot')),
              'description' => 'User likes.'
            ],

            'followers' => [
              'type' => Type::listOf(\GraphQl::type('User')),
              'description' => 'User followers.'
            ],

            'followings' => [
              'type' => Type::listOf(\GraphQl::type('User')),
              'description' => 'User followings.'
            ],
            
        ];
    }
}

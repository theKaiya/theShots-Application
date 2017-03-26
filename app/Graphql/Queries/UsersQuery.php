<?

namespace App\Graphql\Queries;

use App\GraphQL\Support\QueryLimit;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use GraphQL;
use User;

class UsersQuery extends Query
{
 use QueryLimit;
  /**
   * Available relations
   */
  protected $relations;

  /**
   * User model
   */
  protected $users;

  public function type ()
  {
    return Type::listof(GraphQL::type('User'));
  }

  /**
   * Boot method
  */
  public function args ()
  {
    return $this->limit([
        'id' => [
            'type' => Type::id(),
            'description' => 'The id of the user.'
        ],
    ]);
  }

  /**
   * @param $root
   * @param $args
   * @param $context
   * @param ResolveInfo $info
   * @return mixed
   */
  public function resolve ($root, $args, $context, ResolveInfo $info)
  {
      \Debugbar::enable();
      
    $elements = $info->getFieldSelection($depth = 3);

    $this->users = User::orderBy('id', 'desc');

    $this->relations = [
        'shots',
        'likes',
        'comments',
        'user',
        'followers',
        'followings'
    ];

      // id = 1, username = admin, etc...
    $this->users = $this->getByArgs($args);

    $this->users = $this->getWithRelations($elements);

    return $this->users->get()->toArray();

  }

    /**
     * @param $fields
     * @param null $current_field
     *
     * @return mixed
     */
  public function getWithRelations ($fields, $current_field = null)
  {
      if(is_array($fields)) {
          foreach($fields as $field_key => $field_value)
          {
              if(in_array($field_key, $this->relations)){

                  $new_current_field = $current_field ? $current_field.'.'.$field_key : $field_key;

                  $this->users->with($new_current_field);

                  $this->getWithRelations($field_value, $new_current_field);
              }
          }
      }
      return $this->users;
  }

  /**
   * Get user by specific values, e.g user id
   * @param array $args
   * @return mixed
   */
  public function getByArgs (array $args)
  {
    foreach($args as $field => $value)
    {
      $this->users->where($field, $value);
    }

    return $this->users;
  }

}

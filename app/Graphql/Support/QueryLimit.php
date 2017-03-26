<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\GraphQL\Support;

use GraphQL\Type\Definition\Type;
use Illuminate\Database\Query\Builder as QBuilder;
use Illuminate\Database\Eloquent\Builder as EBuilder;
/**
 * Class QueryLimit.
 */
trait QueryLimit
{
    protected $_limit;

    protected $_page;
    /**
     * @param  array $args
     * @return array
     */
    public function limit(array $args)
    {
        return array_merge($args, [
        '_limit' => [
            'type'        => Type::int(),
            'description' => 'Items per page: in 1...1000 range',
        ],
        '_page' => [
            'type'        => Type::int(),
            'description' => 'Current page number (Usage without "_limit" argument gives no effect)',
        ],
    ]);
    }
    
}
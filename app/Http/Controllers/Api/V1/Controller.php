<?php

namespace App\Http\Controllers\Api\V1;

use LaravelJsonApi\Laravel\Http\Controllers\Actions\AttachRelationship;
use LaravelJsonApi\Laravel\Http\Controllers\Actions\Destroy;
use LaravelJsonApi\Laravel\Http\Controllers\Actions\DetachRelationship;
use LaravelJsonApi\Laravel\Http\Controllers\Actions\FetchMany;
use LaravelJsonApi\Laravel\Http\Controllers\Actions\FetchOne;
use LaravelJsonApi\Laravel\Http\Controllers\Actions\FetchRelated;
use LaravelJsonApi\Laravel\Http\Controllers\Actions\FetchRelationship;
use LaravelJsonApi\Laravel\Http\Controllers\Actions\Store;
use LaravelJsonApi\Laravel\Http\Controllers\Actions\Update;
use LaravelJsonApi\Laravel\Http\Controllers\Actions\UpdateRelationship;

class Controller extends \App\Http\Controllers\Controller
{
    use FetchMany;
    use FetchOne;
    use Store;
    use Update;
    use Destroy;
    use FetchRelated;
    use FetchRelationship;
    use UpdateRelationship;
    use AttachRelationship;
    use DetachRelationship;
}

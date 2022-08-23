<?php

namespace Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use LaravelJsonApi\Core\Facades\JsonApi;
use LaravelJsonApi\Testing\MakesJsonApiRequests;

abstract class ApiTestCase extends TestCase
{
    use MakesJsonApiRequests;
    use RefreshDatabase;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->refreshDatabase();
        $this->seed();
    }

    protected function relationshipData($model): array
    {
        $data = Collection::wrap($model)
            ->map(function (Model $model) {
                $schema = JsonApi::server('v1')->schemas()->schemaForModel($model);

                return [
                    'type' => $schema->type(),
                    'id' => $model->getRouteKey(),
                ];
            });

        return [
            'data' => $data->count() > 1
                ? $data->all()
                : $data->first(),
        ];
    }
}

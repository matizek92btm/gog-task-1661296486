<?php

namespace App\JsonApi;

use Illuminate\Http\Response;

class Error extends \LaravelJsonApi\Core\Document\Error
{
    public static function fromStatus(int $status, ?string $detail = null): self
    {
        return static::make()
            ->setStatus($status)
            ->setDetail($detail);
    }

    public function setStatus($status): self
    {
        parent::setStatus($status);

        if ($this->status() && ! $this->title()) {
            $this->setTitle(Response::$statusTexts[$this->status()] ?? null);
        }

        return $this;
    }
}

<?php

namespace Flamarkt\FinalQuantities\Listeners;

use Flamarkt\Core\Order\Event\SavingLine;
use Illuminate\Support\Arr;

class SaveOrderLine
{
    public function handle(SavingLine $event)
    {
        $attributes = (array)Arr::get($event->data, 'attributes');

        if (Arr::exists($attributes, 'originalQuantity')) {
            $event->actor->assertCan('backoffice');

            $event->line->original_quantity = Arr::get($attributes, 'originalQuantity');
        }

        if (Arr::exists($attributes, 'isFinal')) {
            $event->actor->assertCan('backoffice');

            $event->line->is_final = Arr::get($attributes, 'isFinal');
        }
    }
}

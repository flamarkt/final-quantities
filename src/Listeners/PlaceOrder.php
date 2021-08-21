<?php

namespace Flamarkt\FinalQuantities\Listeners;

use Flamarkt\Core\Order\Event\Ordering;

class PlaceOrder
{
    public function handle(Ordering $event)
    {
        foreach ($event->builder->lines as $group => $lines) {
            foreach ($lines as $line) {
                if ($line->type !== 'product') {
                    continue;
                }

                $line->original_quantity = $line->quantity;
            }
        }
    }
}

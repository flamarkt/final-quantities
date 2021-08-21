<?php

namespace Flamarkt\FinalQuantities;

use Flamarkt\Core\Api\Serializer\OrderLineSerializer;
use Flamarkt\Core\Order\OrderLine;

class OrderLineAttributes
{
    public function __invoke(OrderLineSerializer $serializer, OrderLine $line): array
    {
        $attributes = [
            'originalQuantity' => (int)$line->original_quantity,
        ];

        if ($serializer->getActor()->can('backoffice')) {
            $attributes['isFinal'] = (bool)$line->is_final;
        }

        return $attributes;
    }
}

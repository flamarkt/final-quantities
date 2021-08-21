<?php

namespace Flamarkt\FinalQuantities;

use Flamarkt\Core\Api\Serializer\OrderLineSerializer;
use Flamarkt\Core\Order\Event\Ordering;
use Flamarkt\Core\Order\Event\SavingLine;
use Flarum\Extend;

return [
    (new Extend\Frontend('backoffice'))
        ->js(__DIR__ . '/js/dist/backoffice.js'),

    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/resources/less/forum.less'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\Event())
        ->listen(Ordering::class, Listeners\PlaceOrder::class)
        ->listen(SavingLine::class, Listeners\SaveOrderLine::class),

    (new Extend\ApiSerializer(OrderLineSerializer::class))
        ->attributes(OrderLineAttributes::class),
];

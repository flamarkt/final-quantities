<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->table('flamarkt_order_lines', function (Blueprint $table) {
            $table->unsignedInteger('original_quantity')->default(0);
            $table->boolean('is_final')->default(false);
        });
    },
    'down' => function (Builder $schema) {
        $schema->table('flamarkt_order_lines', function (Blueprint $table) {
            $table->dropColumn('original_quantity');
            $table->dropColumn('is_final');
        });
    },
];

<?php

dataset('api_response', fn() => [
    yield fn() => [
        [
            'title' => fake()->name,
            'email' => fake()->email,
            'precalc_ongoing' => 100000,
        ],
        [
            'title' => fake()->name,
            'email' => fake()->email,
            'precalc_ongoing' => 100000,
        ],
    ]
]);

dataset('api_response_low_balance', fn() => [
    yield fn() => [
        [
            'title' => fake()->name,
            'email' => fake()->email,
            'precalc_ongoing' => 0,
        ],
        [
            'title' => fake()->name,
            'email' => fake()->email,
            'precalc_ongoing' => 0,
        ],
    ]
]);

public array $globals = [
    'before' => [
        'cors', // Adicione 'cors' no array 'before'
    ],
];

public array $aliases = [
    'cors' => \App\Filters\Cors::class,
];
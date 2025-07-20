<?php
header('Content-Type: application/json');

$url = 'https://date.nager.at/api/v3/PublicHolidays/2025/BR';
$content = file_get_contents($url);
$feriadosNacionais = json_decode($content, true);

$feriadosJudaicos = [
    ['date' => '2025-09-25', 'name' => 'Yom Kippur'],
    ['date' => '2026-09-14', 'name' => 'Yom Kippur'],
    ['date' => '2027-10-03', 'name' => 'Yom Kippur'],
    ['date' => '2028-09-21', 'name' => 'Yom Kippur'],
    ['date' => '2029-09-11', 'name' => 'Yom Kippur'],
];

// Monta array para FullCalendar
$eventos = [];

foreach ($feriadosNacionais as $feriado) {
    // Fundo do dia
    $eventos[] = [
        'start' => $feriado['date'],
        'allDay' => true,
        'display' => 'background',
        'color' => '#ffcccc',
        'extendedProps' => ['isFeriado' => true],
    ];

    // Texto do feriado
    $eventos[] = [
        'title' => $feriado['localName'],
        'start' => $feriado['date'],
        'allDay' => true,
        'color' => '#ff0000',
        'textColor' => '#ffffff',
        'extendedProps' => ['isFeriado' => true],
    ];
}

foreach ($feriadosJudaicos as $judaico) {
    // Fundo
    $eventos[] = [
        'start' => $judaico['date'],
        'allDay' => true,
        'display' => 'background',
        'color' => '#ccf2ff',
        'extendedProps' => ['isFeriado' => true],
    ];

    // Texto
    $eventos[] = [
        'title' => $judaico['name'],
        'start' => $judaico['date'],
        'allDay' => true,
        'color' => '#00aaff',
        'textColor' => '#ffffff',
        'extendedProps' => ['isFeriado' => true],
    ];
}




echo json_encode($eventos);

<?php

declare(strict_types=1);

// A tiny local USSD menu simulator. No API or callback service is needed.
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

if ($path === '/' && ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'GET') {
    header('Content-Type: text/html; charset=utf-8');
    echo '<!doctype html><html lang="en"><meta charset="utf-8"><title>USSD menu lesson</title>'
        . '<h1>USSD menu lesson</h1><p>Send a choice to the local simulator:</p>'
        . '<form method="post" action="/ussd"><label>Choice so far: '
        . '<input name="text" placeholder="Leave empty for start"></label> '
        . '<button type="submit">Show screen</button></form>'
        . '<p>Examples: empty input opens the main menu; <code>1</code> opens option 1; '
        . '<code>1*2</code> chooses option 2 inside option 1.</p></html>';
    exit;
}

if ($path !== '/ussd' || ($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    http_response_code(404);
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Not found';
    exit;
}

header('Content-Type: text/plain; charset=utf-8');
$text = trim((string) ($_POST['text'] ?? ''));
$choices = $text === '' ? [] : explode('*', $text);

// "0" backs up one level. "9" returns to the first screen.
if ($choices !== [] && end($choices) === '9') {
    $choices = [];
} elseif ($choices !== [] && end($choices) === '0') {
    array_pop($choices);
    if ($choices !== []) {
        array_pop($choices);
    }
}

$show = static function (string $message, bool $finish = false): never {
    echo ($finish ? 'END ' : 'CON ') . $message;
    exit;
};

// No choices yet: show the main menu.
if ($choices === []) {
    $show("Welcome!\n1. Learn about USSD\n2. Say hello");
}

// The first choice selects a branch of the menu.
if ($choices[0] === '1' && count($choices) === 1) {
    $show("USSD basics\nUSSD menus show one screen at a time.\n0. Back\n9. Home");
}

if ($choices[0] === '2' && count($choices) === 1) {
    $show("Hello! You selected option 2.\n0. Back\n9. Home");
}

$show("Sorry, that choice is not available.\n0. Back\n9. Home");

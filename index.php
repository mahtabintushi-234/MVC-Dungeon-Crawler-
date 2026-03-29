<?php
/**
 *index.php
 *
 * I Mahtabin Tushi, 000952184, certify that this material is my original work.
 * No other person's work has been used without suitable acknowledgment and I have not made
 * my work available to anyone else.
 *
 * @author Mahtabin Tushi
 * @version 202535.00   
 * @package COMP 10260 Assignment 4
 */

session_start();

// Include the model
require_once 'model.php';
$model = new DungeonModel();

/**
 * Parse the request path (after .htaccess rewrite) and route accordingly.
 */
$path = strtok($_SERVER['REQUEST_URI'], '?');
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
if ($base !== '' && strpos($path, $base) === 0) {
    $path = substr($path, strlen($base));
}

// Routing
switch (true) {
    // Start the game
    case ($path === '/start'):
        $_SESSION['room'] = 22;
        $_SESSION['orientation'] = 'North';
        $_SESSION['started'] = true;
        render('dungeon');
        exit;

    // Turn right
    case ($path === '/turn/right'):
        $_SESSION['orientation'] = rotateOrientation($_SESSION['orientation'], 'right');
        render('dungeon');
        exit;

    // Turn left
    case ($path === '/turn/left'):
        $_SESSION['orientation'] = rotateOrientation($_SESSION['orientation'], 'left');
        render('dungeon');
        exit;

    // Go forward to a room
    case (strpos($path, '/goto/') === 0):
        $target = (int)substr($path, strlen('/goto/'));
        $room   = $model->getRoom($_SESSION['room']);
        $forwardRoom = forwardRoomId($room, $_SESSION['orientation']);
        if ($forwardRoom !== null && $forwardRoom === $target) {
            $_SESSION['room'] = $target;
        }
        render('dungeon');
        exit;

    // Default: entrance or dungeon depending on session
    default:
        if (!isset($_SESSION['started']) || $_SESSION['started'] === false) {
            render('entrance');
        } else {
            render('dungeon');
        }
        exit;
}

/**
 * Render the specified view.
 *
 * @param string $view The view name to render ("entrance" or "dungeon").
 * @return void Outputs the corresponding view template.
 */
function render(string $view) {
    global $model;

    if ($view === 'entrance') {
        $TPL = [
            'base_path' => '/~sa000952184/private/10260/a4/',
        ];
        require 'view.entrance.php';
        return;
    }

    // Dungeon view
    $room = $model->getRoom($_SESSION['room']);
    if (!$room) {
        $_SESSION['started'] = false;
        render('entrance');
        return;
    }

    $encounter = !empty($room['encounter_id'])
        ? $model->getEncounter($room['encounter_id'])
        : null;

    $TPL = [
        'base_path' => '/~sa000952184/private/10260/a4/',
        'encounter' => $encounter,
        'dungeon_background' => getBackgroundImage($room, $_SESSION['orientation']),
        'forward' => forwardRoomId($room, $_SESSION['orientation']),
    ];

    require 'view.dungeon.php';
}

/**
 * Rotate orientation left or right.
 *
 * @param string $orientation Current orientation ("North", "East", "South", "West").
 * @param string $dir Direction to rotate ("left" or "right").
 * @return string The new orientation after rotation.
 */
function rotateOrientation(string $orientation, string $dir): string {
    $order = ['North', 'East', 'South', 'West'];
    $i = array_search($orientation, $order, true);
    if ($i === false) $i = 0;
    return ($dir === 'right')
        ? $order[($i + 1) % 4]
        : $order[($i + 3) % 4];
}

/**
 * Map orientation to DB column and return forward room id.
 *
 * @param array $room The current room data from the database.
 * @param string $orientation Current orientation ("North", "East", "South", "West").
 * @return int|null The ID of the forward room, or null if none exists.
 */
function forwardRoomId(array $room, string $orientation): ?int {
    $map = [
        'North' => 'north',
        'East'  => 'east',
        'South' => 'south',
        'West'  => 'west',
    ];
    $col = $map[$orientation] ?? null;
    return ($col && !empty($room[$col])) ? (int)$room[$col] : null;
}

/**
 * Build background image filename based on doors relative to orientation.
 *
 * @param array $room The current room data from the database.
 * @param string $orientation Current orientation ("North", "East", "South", "West").
 * @return string Filename of the background image (e.g., "LF.png", "NONE.png").
 */
function getBackgroundImage(array $room, string $orientation): string {
    $dirs = [
        'North' => ['left' => 'west',  'right' => 'east',  'forward' => 'north'],
        'East'  => ['left' => 'north', 'right' => 'south', 'forward' => 'east'],
        'South' => ['left' => 'east',  'right' => 'west',  'forward' => 'south'],
        'West'  => ['left' => 'south', 'right' => 'north', 'forward' => 'west'],
    ];
    $d = $dirs[$orientation] ?? [];

    $parts = [];
    if (!empty($room[$d['left']]))    $parts[] = 'L';
    if (!empty($room[$d['forward']])) $parts[] = 'F';
    if (!empty($room[$d['right']]))   $parts[] = 'R';

    return ($parts ? implode('', $parts) : 'NONE') . '.png';
}
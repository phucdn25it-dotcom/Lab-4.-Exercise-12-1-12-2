<?php
// Keep the task list when the browser is closed and reopened.
session_set_cookie_params(60 * 60 * 24 * 365 * 3, '/');
session_start();

if (!isset($_SESSION['tasks']) || !is_array($_SESSION['tasks'])) {
    $_SESSION['tasks'] = array();
}

$action = filter_input(INPUT_POST, 'action');
if ($action === 'add') {
    $task = trim((string) filter_input(INPUT_POST, 'task'));
    if ($task !== '') {
        $_SESSION['tasks'][] = $task;
    }
} elseif ($action === 'update') {
    // The list is submitted as hidden fields so it remains available to PHP.
    $posted_tasks = filter_input(INPUT_POST, 'tasks', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    $posted_tasks = is_array($posted_tasks) ? $posted_tasks : array();
    $remove = filter_input(INPUT_POST, 'remove', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    $remove = is_array($remove) ? array_map('intval', $remove) : array();

    $_SESSION['tasks'] = array();
    foreach ($posted_tasks as $index => $task) {
        if (!in_array((int) $index, $remove, true) && trim((string) $task) !== '') {
            $_SESSION['tasks'][] = trim((string) $task);
        }
    }
}

$tasks = $_SESSION['tasks'];
include 'task_list.php';

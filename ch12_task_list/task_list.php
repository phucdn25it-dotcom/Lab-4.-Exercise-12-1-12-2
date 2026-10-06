<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task List Manager</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 42rem; margin: 2rem auto; padding: 0 1rem; }
        li { margin: .5rem 0; }
        .task { margin-left: .5rem; }
        .session { color: #555; font-size: .85rem; }
    </style>
</head>
<body>
    <h1>Task List Manager</h1>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="add">
        <label for="task">New task:</label>
        <input type="text" id="task" name="task" required maxlength="200">
        <button type="submit">Add Task</button>
    </form>

    <h2>Tasks</h2>
    <?php if (empty($tasks)) : ?>
        <p>No tasks yet.</p>
    <?php else : ?>
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="update">
            <ul>
                <?php foreach ($tasks as $index => $task) : ?>
                    <li>
                        <input type="hidden" name="tasks[<?php echo (int) $index; ?>]"
                               value="<?php echo htmlspecialchars($task, ENT_QUOTES, 'UTF-8'); ?>">
                        <label>
                            <input type="checkbox" name="remove[]" value="<?php echo (int) $index; ?>">
                            Remove
                        </label>
                        <span class="task"><?php echo htmlspecialchars($task, ENT_QUOTES, 'UTF-8'); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <button type="submit">Update Task List</button>
        </form>
    <?php endif; ?>

    <p class="session">Session ID: <?php echo htmlspecialchars(session_id(), ENT_QUOTES, 'UTF-8'); ?></p>
</body>
</html>

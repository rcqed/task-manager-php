<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Task Management</title>
</head>
<body>
    <h1>Task List</h1>
    <ul>
        <?php
        // 获取当前目录下的所有文件夹
        $folders = array_filter(glob('*'), 'is_dir');

        // 遍历文件夹列表并显示链接
        foreach ($folders as $folder) {
            echo '<li><a href="show_tasks.php?folder=' . urlencode($folder) . '">' . $folder . '</a></li>';
        }
        ?>
    </ul>
</body>
</html>

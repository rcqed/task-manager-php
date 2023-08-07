<!DOCTYPE html>
<html>
<head>
    <title>Show Tasks</title>
</head>
<body>
<?php
$folder = $_GET['folder'] ?? '';
$targetDir = "./$folder/";

if (!is_dir($targetDir)) {
    echo "Folder not found!";
    exit;
}

$excludedFiles = ["main.cmd", "participants.txt", "Project-File-Renamer.py"];
$files = array_diff(scandir($targetDir), ['.', '..']);

$part1s = [];
$part2s = [];
$data = [];

foreach ($files as $file) {
    if (!in_array($file, $excludedFiles)) {
        $parts = explode('__', $file);
        if (count($parts) === 3) {
            $part1 = $parts[0];
            $part2 = $parts[1];
            $part3 = $parts[2];

            if (!in_array($part1, $part1s)) {
                $part1s[] = $part1;
            }

            if (!in_array($part2, $part2s)) {
                $part2s[] = $part2;
            }

            $data[$part1][$part2][] = $part3;
        }
    }
}

echo '<table border="1">';
echo '<tr><th></th>';

foreach ($part2s as $part2) {
    echo '<th>' . $part2 . '</th>';
}

echo '</tr>';

foreach ($part1s as $part1) {
    echo '<tr>';
    echo '<td>' . $part1 . '</td>';

    foreach ($part2s as $part2) {
        echo '<td>';

        if (isset($data[$part1][$part2])) {
            foreach ($data[$part1][$part2] as $part3) {
                $fileLink = $folder . '/' . $part1 . '__' . $part2 . '__' . $part3;
                echo '<a href="' . $fileLink . '">' . $part3 . '</a><br>';
            }
        }

        echo '</td>';
    }

    echo '</tr>';
}

echo '</table>';
?>
</body>
</html>

<?php if (isset($_GET['code'])) {die(highlight_file(__File__, 1)); }?>

<?php
$json = file_get_contents('Restoran.json');
$data = json_decode($json, true);
?>

<!doctype html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoran</title>
</head>
<body>
<h1>Restoran</h1>
<a href="andmed_xml.php">XML vorm</a>

<h2>Tellimuste tabel</h2>
<table border="1">
    <tr>
        <th>Tellimus ID</th>
        <th>Teenindaja Nimi</th>
        <th>Teenindaja Tunnus</th>
        <th>Toit</th>
        <th>Jook</th>
        <th>Laud Number</th>
        <th>Laud Mahutavus</th>
        <th>Laud Asukoht</th>
        <th>Laud Seisukord</th>
        <th>Tellimuse Seisund</th>
    </tr>
    <?php
    foreach ($data['restoran']['tellimus'] as $tellimus) {
        echo "<tr>";
        echo "<td>" . ($tellimus['tellimusId']) . "</td>";
        echo "<td>" . ($tellimus['teenindaja']['nimi']) . "</td>";
        echo "<td>" . ($tellimus['teenindaja']['tunnus']) . "</td>";
        echo "<td>" . ($tellimus['menu']['toit']) . "</td>";
        echo "<td>" . ($tellimus['menu']['jook']) . "</td>";
        echo "<td>" . ($tellimus['laud']['number']) . "</td>";
        echo "<td>" . ($tellimus['laud']['mahutavus']) . "</td>";
        echo "<td>" . ($tellimus['laud']['asukoht']) . "</td>";
        echo "<td>" . ($tellimus['laud']['seisukord']) . "</td>";
        echo "<td>" . ($tellimus['tellimusestaatus']) . "</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>

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

<h3>Toidud</h3>
<table border="1">
    <tr>
        <th>Nimi</th>
        <th>Hind</th>
        <th>Kategooria</th>
    </tr>
    <?php foreach ($data['restoran']['menu']['toit'] as $toit): ?>
        <tr>
            <td><?= htmlspecialchars($toit['nimi']) ?></td>
            <td><?= htmlspecialchars($toit['hind']) ?></td>
            <td><?= htmlspecialchars($toit['kategooria']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h3>Joogid</h3>
<table border="1">
    <tr>
        <th>Nimi</th>
        <th>Hind</th>
        <th>Kategooria</th>
    </tr>
    <?php foreach ($data['restoran']['menu']['jook'] as $jook): ?>
        <tr>
            <td><?= htmlspecialchars($jook['nimi']) ?></td>
            <td><?= htmlspecialchars($jook['hind']) ?></td>
            <td><?= htmlspecialchars($jook['kategooria']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Lauad</h2>
<table border="1">
    <tr>
        <th>Laua number</th>
        <th>Mahutavus</th>
        <th>Koht</th>
        <th>Seisukord</th>
        <th>Sees/Väljas</th>
    </tr>
    <?php foreach ($data['restoran']['laud'] as $laud): ?>
        <tr>
            <td><?= htmlspecialchars($laud['number']) ?></td>
            <td><?= htmlspecialchars($laud['mahutavus']) ?></td>
            <td><?= htmlspecialchars($laud['asukoht']) ?></td>
            <td><?= htmlspecialchars($laud['seisukord']) ?></td>
            <td><?= htmlspecialchars($laud['asukoht'] === 'A' ? 'Sees' : 'Väljas') ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Teenindajad</h2>
<table border="1">
    <tr>
        <th>Teenindaja nimi</th>
        <th>Teenindaja number</th>
    </tr>
    <?php foreach ($data['restoran']['teenindaja'] as $teenindaja): ?>
        <tr>
            <td><?= htmlspecialchars($teenindaja['nimi']) ?></td>
            <td><?= htmlspecialchars($teenindaja['tunnus']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Tellimused</h2>
<table border="1">
    <tr>
        <th>Id</th>
        <th>Teenindaja</th>
        <th>Tellimusestaatus</th>
    </tr>
    <?php foreach ($data['restoran']['tellimus'] as $tellimus): ?>
        <tr>
            <td><?= htmlspecialchars($tellimus['id']) ?></td>
            <td><?= htmlspecialchars($tellimus['teenindaja']) ?></td>
            <td><?= htmlspecialchars($tellimus['tellimusestaatus']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>

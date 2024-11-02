<?php if (isset($_GET['code'])) {die(highlight_file(__File__, 1)); }?>
<?php
$xml = simplexml_load_file('Restoran.xml');

$selected_kategooria = isset($_GET['kategooria']) ? $_GET['kategooria'] : '';

$categories = [];
foreach ($xml->menu->toit as $toit) {
    $categories[] = (string)$toit->kategooria;
}
$categories = array_unique($categories);
?>




<!doctype html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restoran</title>
</head>
<body>
<h1>Restoran</h1>
<a href="andmed_json.php">JSON vorm</a>

<table border="1">
    <tr>
        <th>Nimi</th>
        <th>Hind</th>
        <th>Kategooria</th>
    </tr>
    <?php
    echo "<h2>Toidud:</h2>";
    foreach ($xml->menu->toit as $toit) {
        echo "<tr>";
        echo "<td>" . $toit->nimi . "</td>";
        echo "<td>" . $toit->hind . "</td>";
        echo "<td>" . $toit->kategooria . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<table border="1">
    <tr>
        <th>Nimi</th>
        <th>Hind</th>
        <th>Kategooria</th>
    </tr>
    <?php
    echo "<h2>Toidud:</h2>";
    foreach ($xml->menu->jook as $jook) {
        echo "<tr>";
        echo "<td>" . $jook->nimi . "</td>";
        echo "<td>" . $jook->hind . "</td>";
        echo "<td>" . $jook->kategooria . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<table border="1">
    <tr>
        <th>Laua number</th>
        <th>Mahutavus</th>
        <th>Koht</th>
        <th>Seisukord</th>
    </tr>
    <?php
    echo "<h2>Lauad:</h2>";
    foreach ($xml->laud as $laud) {
        echo "<tr>";
        echo "<td>" . $laud->number . "</td>";
        echo "<td>" . $laud->mahutavus . "</td>";
        echo "<td>" . $laud->asukoht . "</td>";
        echo "<td>" . $laud->seisukord . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<table border="1">
    <tr>
        <th>Teenindaja nimi</th>
        <th>Teenindaja number</th>

    </tr>
    <?php
    echo "<h2>Teenindajad:</h2>";
    foreach ($xml->teenindaja as $teenindaja) {
        echo "<tr>";
        echo "<td>" . $teenindaja->nimi . "</td>";
        echo "<td>" . $teenindaja->tunnus . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<table border="1">
    <tr>
        <th>Id</th>
        <th>Teenindaja</th>
        <th>Tellimusestaatus</th>

    </tr>
    <?php
    echo "<h2>Teenindajad:</h2>";
    foreach ($xml->tellimus as $tellimus) {
        echo "<tr>";
        echo "<td>" . $tellimus->id . "</td>";
        echo "<td>" . $tellimus->teenindaja . "</td>";
        echo "<td>" . $tellimus->tellimusestaatus . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<table border="1">
    <tr>
        <th>Nimi</th>
        <th>Hind</th>
        <th>Kategooria</th>
        <th>Hindade kategooria</th>
    </tr>
    <?php
    echo "<h2>Funktsioon 1: Lisa veel üks rida, kus näeme hinna kategooria ja mõistlik värv</h2>";
    foreach ($xml->menu->toit as $toit) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($toit->nimi) . "</td>";
        echo "<td>" . htmlspecialchars($toit->hind) . "</td>";
        echo "<td>" . htmlspecialchars($toit->kategooria) . "</td>";

        $price = (float) $toit->hind;
        if ($price <= 6) {
            echo "<td style='background-color: green; color: white;'>Odav</td>";
        } elseif ($price <= 10) {
            echo "<td style='background-color: yellow;'>Kallis</td>";
        } else {
            echo "<td style='background-color: red; color: white;'>Väga kallis</td>";
        }

        echo "</tr>";
    }
    ?>
</table>

<h2>Funktsioon 2: Toidud kategooria järgi</h2>
<form method="GET">
    <label for="kategooria">Vali kategooria:</label>
    <select name="kategooria" id="kategooria">
        <option value="">Vali kategooria</option>
        <?php foreach ($categories as $kategooria): ?>
            <option value="<?= htmlspecialchars($kategooria) ?>" <?= $kategooria === $selected_kategooria ? 'selected' : '' ?>>
                <?= htmlspecialchars($kategooria) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Filtreeri">
</form>
<table border="1">
    <tr>
        <th>Nimi</th>
        <th>Hind</th>
        <th>Kategooria</th>
    </tr>
    <h2>Toidud (kategooria: <?= htmlspecialchars($selected_kategooria) ?>):</h2>
    <?php foreach ($xml->menu->toit as $toit): ?>
        <?php if ($selected_kategooria === '' || $toit->kategooria == $selected_kategooria): ?>
            <tr>
                <td><?= htmlspecialchars($toit->nimi) ?></td>
                <td><?= htmlspecialchars($toit->hind) ?></td>
                <td><?= htmlspecialchars($toit->kategooria) ?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>

<h2>Funktsioon 3: Kui koht on A siis kirjutame, et see on sees ja kui on B siis Väljas</h2>
<table border="1">
    <tr>
        <th>Laua number</th>
        <th>Mahutavus</th>
        <th>Koht</th>
        <th>Seisukord</th>
        <th>Sees/Väljas</th>
    </tr>
    <?php
    foreach ($xml->laud as $laud) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($laud->number) . "</td>";
        echo "<td>" . htmlspecialchars($laud->mahutavus) . "</td>";
        echo "<td>" . htmlspecialchars($laud->asukoht) . "</td>";
        echo "<td>" . htmlspecialchars($laud->seisukord) . "</td>";

        $sees_valjas = ($laud->asukoht == 'A') ? 'Sees' : 'Väljas';
        echo "<td>" . htmlspecialchars($sees_valjas) . "</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>

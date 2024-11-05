<?php if (isset($_GET['code'])) {die(highlight_file(__File__, 1)); }?>

<?php
//saame väärtused vormist
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tellimusId = $_POST['tellimusId'];
    $teenindajaNimi = $_POST['teenindajaNimi'];
    $teenindajaTunnus = $_POST['teenindajaTunnus'];
    $toit = $_POST['toit'];
    $jook = $_POST['jook'];
    $laudNumber = $_POST['laudNumber'];
    $laudMahutavus = $_POST['laudMahutavus'];
    $laudAsukoht = $_POST['laudAsukoht'];
    $laudSeisukord = $_POST['laudSeisukord'];
    $tellimusestaatus = $_POST['tellimusestaatus'];

//lugeme andmed .json failist ja dekodeerime neid

    $json = file_get_contents('Restoran.json');
    $data = json_decode($json, true);

//kontrollime kas on olemas duplikaatid või mitte.
//(väljad: laua number, laua mahutavus, laua asukoht ja laua seisukord on broneeritud)
//kui duplikaadi pole siis salvestame andmed uue massiivi

    $duplicateId = false;
    $duplicateTableLocationCapacity = false;

    foreach ($data['restoran']['tellimus'] as $tellimus) {
        if ($tellimus['tellimusId'] == $tellimusId) {
            $duplicateId = true;
            break;
        }

        if (
            $tellimus['laud']['number'] == $laudNumber &&
            $tellimus['laud']['mahutavus'] == $laudMahutavus &&
            $tellimus['laud']['asukoht'] == $laudAsukoht &&
            $tellimus['laud']['seisukord'] == 'Broneeritud'
        ) {
            $duplicateTableLocationCapacity = true;
            break;
        }
    }

    if ($duplicateId) {
        echo "<p style='color:red;'>Tellimus ID {$tellimusId} juba eksisteerib! Palun kasuta unikaalset ID-d.</p>";
    } elseif ($duplicateTableLocationCapacity) {
        echo "<p style='color:red;'>Lauale number {$laudNumber} (Mahutavus: {$laudMahutavus}, Asukoht: {$laudAsukoht}) on määratud staatus 'Broneeritud'! Palun vali teistsugune laud või asukoht.</p>";
    } else {
        $newOrder = [
            'tellimusId' => $tellimusId,
            'teenindaja' => [
                'nimi' => $teenindajaNimi,
                'tunnus' => $teenindajaTunnus
            ],
            'menu' => [
                'toit' => $toit,
                'jook' => $jook
            ],
            'laud' => [
                'number' => $laudNumber,
                'mahutavus' => $laudMahutavus,
                'asukoht' => $laudAsukoht,
                'seisukord' => $laudSeisukord
            ],
            'tellimusestaatus' => $tellimusestaatus
        ];


//kirjutame andmed uuest massiivist .json failisse -> restoran-tellimus-massiivi andmed

    $data['restoran']['tellimus'][] = $newOrder;

    file_put_contents('Restoran.json', json_encode($data, JSON_PRETTY_PRINT));

    echo "Tellimus lisatud edukalt!";

//vältime f5/värskendust
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
}

//lugeme andmed .json failist ja dekodeerime
$json = file_get_contents('Restoran.json');
$data = json_decode($json, true);
?>

<!doctype html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoran</title>
    <link rel="stylesheet" href="a_json_style.css">
</head>
<body>
<h1>Restoran</h1>
<a href="andmed_xml.php">XML kuju</a>

<h2>Tellimuste tabel</h2>
<table border="1">
    <tr>
        <th>Tellimus ID</th>
        <th>Teenindaja Nimi</th>
        <th>Teenindaja Tunnus</th>
        <th>Toit</th>
        <th>Jook</th>
        <th>Laua Number</th>
        <th>Laua Mahutavus</th>
        <th>Laua Asukoht</th>
        <th>Laua Seis</th>
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

<h2>Tellimuste lisamise vorm</h2>
<form method="POST">
    <input type="number" id="tellimusId" name="tellimusId" placeholder="Tellimus ID" required><br><br>

    <input type="text" id="teenindajaNimi" name="teenindajaNimi" placeholder="Teenindaja nimi" required><br><br>

    <input type="number" id="teenindajaTunnus" name="teenindajaTunnus" placeholder="Teenindaja tunnus" required><br><br>

    <input type="text" id="toit" name="toit" placeholder="Toit" required><br><br>

    <input type="text" id="jook" name="jook" placeholder="Jook" required><br><br>

    <input type="number" id="laudNumber" name="laudNumber" placeholder="Laud number" required><br><br>

    <select id="laudMahutavus" name="laudMahutavus" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select><br><br>

    <select id="laudAsukoht" name="laudAsukoht" required>
        <option value="A">A</option>
        <option value="B">B</option>
    </select><br><br>

    <select id="laudSeisukord" name="laudSeisukord" required>
        <option value="Broneeritud">Broneeritud</option>
        <option value="Vaba">Vaba</option>
    </select><br><br>

    <select id="tellimusestaatus" name="tellimusestaatus" required>
        <option value="Ei ole valmis">Ei ole valmis</option>
        <option value="Valmis">Valmis</option>
    </select><br><br>

    <input type="submit" value="Lisa tellimus">
</form>

</body>
</html>

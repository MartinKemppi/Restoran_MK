<?php if (isset($_GET['code'])) {die(highlight_file(__File__, 1)); }?>
<?php
$xml = simplexml_load_file('Restoran.xml');

//salvestame andmed massiivisse
//tsükli läbi näitame kõik andmed seotud teenindaja nime järgi
$teenindajad = [];
foreach ($xml->tellimus as $tellimus) {
    $teenindajad[(string)$tellimus->teenindaja->nimi] = (string)$tellimus->teenindaja->nimi;
}

//kontrollime, kas teenindaja on valitud
$selectedTeenindaja = isset($_POST['teenindaja']) ? $_POST['teenindaja'] : '';

?>

<!doctype html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restoran</title>
    <link rel="stylesheet" href="a_xml_style.css">
</head>
<body>
<h1>Restoran</h1>
<a href="andmed_json.php">JSON kuju</a>

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
    foreach ($xml->tellimus as $tellimus) {
        echo "<tr>";
        echo "<td>" . $tellimus->tellimusId . "</td>";
        echo "<td>" . $tellimus->teenindaja->nimi . "</td>";
        echo "<td>" . $tellimus->teenindaja->tunnus . "</td>";
        echo "<td>" . $tellimus->menu->toit . "</td>";
        echo "<td>" . $tellimus->menu->jook . "</td>";
        echo "<td>" . $tellimus->laud->number . "</td>";
        echo "<td>" . $tellimus->laud->mahutavus . "</td>";
        echo "<td>" . $tellimus->laud->asukoht . "</td>";
        echo "<td>" . $tellimus->laud->seisukord . "</td>";
        echo "<td>" . $tellimus->tellimusestaatus . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<!--
    Valime teenindaja ja kuvame temaga seotud andmed funktsioonist
-->
<h2>Vali Teenindaja:</h2>
<form method="post">
    <select name="teenindaja" onchange="this.form.submit()">
        <option value="">Vali teenindaja</option>
        <?php foreach ($teenindajad as $nimi): ?>
            <option value="<?= htmlspecialchars($nimi) ?>" <?= $selectedTeenindaja == $nimi ? 'selected' : '' ?>>
                <?= htmlspecialchars($nimi) ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<?php if ($selectedTeenindaja): ?>
    <h2>Funktsioon 1: Kõik tellimused, kes vormistas: <?= htmlspecialchars($selectedTeenindaja) ?></h2>
    <table border="1">
        <tr>
            <th>Tellimus ID</th>
            <th>Toit</th>
            <th>Jook</th>
            <th>Laua Number</th>
            <th>Laua Mahutavus</th>
            <th>Laua Asukoht</th>
            <th>Laua Seis</th>
            <th>Tellimuse Seisund</th>
        </tr>
        <?php
        foreach ($xml->tellimus as $tellimus) {
            if ((string)$tellimus->teenindaja->nimi === $selectedTeenindaja) {
                echo "<tr>";
                echo "<td>" . ($tellimus->tellimusId) . "</td>";
                echo "<td>" . ($tellimus->menu->toit) . "</td>";
                echo "<td>" . ($tellimus->menu->jook) . "</td>";
                echo "<td>" . ($tellimus->laud->number) . "</td>";
                echo "<td>" . ($tellimus->laud->mahutavus) . "</td>";
                echo "<td>" . ($tellimus->laud->asukoht) . "</td>";
                echo "<td>" . ($tellimus->laud->seisukord) . "</td>";
                echo "<td>" . ($tellimus->tellimusestaatus) . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
<?php endif; ?>

<h2>Funktsioon 2: Värvime valmis tellimused roheliseks, mitte valmis punaseks</h2>
<table border="1">
    <tr>
        <th>Tellimus ID</th>
        <th>Toit</th>
        <th>Jook</th>
        <th>Laua Number</th>
        <th>Laua Mahutavus</th>
        <th>Laua Asukoht</th>
        <th>Laua Seis</th>
        <th>Tellimuse Seisund</th>
    </tr>

    <!--
    Tsükli läbi vätame väli ja kontrollime väärtuse ja anname pos. tulemusele roheline/ neg. tulemusele punane
    TrColor andme tagastamine kumb oli väär/õige värviga
    -->
    <?php
    foreach ($xml->tellimus as $tellimus) {
        $trColor = ($tellimus->tellimusestaatus == 'Valmis') ? 'MediumSeaGreen' : 'Tomato';
        echo "<tr style='background-color: $trColor;'>";
        echo "<td>" . ($tellimus->tellimusId) . "</td>";
        echo "<td>" . ($tellimus->menu->toit) . "</td>";
        echo "<td>" . ($tellimus->menu->jook) . "</td>";
        echo "<td>" . ($tellimus->laud->number) . "</td>";
        echo "<td>" . ($tellimus->laud->mahutavus) . "</td>";
        echo "<td>" . ($tellimus->laud->asukoht) . "</td>";
        echo "<td>" . ($tellimus->laud->seisukord) . "</td>";
        echo "<td>" . ($tellimus->tellimusestaatus) . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<h2>Funktsioon 3: Rida, mis annab teada, kas on väljas või sees laua asukohast</h2>
<table border="1">
    <tr>
        <th>Tellimus ID</th>
        <th>Toit</th>
        <th>Jook</th>
        <th>Laua Number</th>
        <th>Laua Mahutavus</th>
        <th>Laua Asukoht</th>
        <th>Laua Seis</th>
        <th>Tellimuse Seisund</th>
        <th>Väljas/Sees</th>
    </tr>

    <!--
    Tsükli läbi vätame laua asukoht, kus A on Sees, B on väljas.
    Lisanud veel üks rida asukoha täpsustamiseks
    -->
    <?php
    foreach ($xml->tellimus as $tellimus) {
        $VA_SE = ($tellimus->laud->asukoht == 'A') ? 'Sees' : 'Väljas';

        echo "<tr>";
        echo "<td>" . ($tellimus->tellimusId) . "</td>";
        echo "<td>" . ($tellimus->menu->toit) . "</td>";
        echo "<td>" . ($tellimus->menu->jook) . "</td>";
        echo "<td>" . ($tellimus->laud->number) . "</td>";
        echo "<td>" . ($tellimus->laud->mahutavus) . "</td>";
        echo "<td>" . ($tellimus->laud->asukoht) . "</td>";
        echo "<td>" . ($tellimus->laud->seisukord) . "</td>";
        echo "<td>" . ($tellimus->tellimusestaatus) . "</td>";
        echo "<td>" . ($VA_SE) . "</td>";
        echo "</tr>";

    }
    ?>
</table>

</body>
</html>

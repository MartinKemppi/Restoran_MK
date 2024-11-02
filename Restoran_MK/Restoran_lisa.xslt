<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:msxsl="urn:schemas-microsoft-com:xslt" exclude-result-prefixes="msxsl">

	<xsl:output method="html" indent="yes" encoding="utf-8"/>

	<xsl:template match="/">
		<html>
			<head>
				<title>Restoran</title>
			</head>
			<body>
				<h1>Restoran</h1>

				<h2>Tellimuste tabel</h2>
				<table border="1">
					<tr>
						<th>Tellimus ID</th>
						<th>Teenindaja nimi</th>
						<th>Teenindaja tunnus</th>
						<th>Toit</th>
						<th>Jook</th>
						<th>Laua Number</th>
						<th>Laua Mahutavus</th>
						<th>Laua Asukoht</th>
						<th>Laua Seisukord</th>
						<th>Tellimuse Staatus</th>
					</tr>
					<xsl:for-each select="restoran/tellimus">
						<tr>
							<td>
								<xsl:value-of select="tellimusId"/>
							</td>
							<td>
								<xsl:value-of select="teenindaja/nimi"/>
							</td>
							<td>
								<xsl:value-of select="teenindaja/tunnus"/>
							</td>
							<td>
								<xsl:value-of select="menu/toit"/>
							</td>
							<td>
								<xsl:value-of select="menu/jook"/>
							</td>
							<td>
								<xsl:value-of select="laud/number"/>
							</td>
							<td>
								<xsl:value-of select="laud/mahutavus"/>
							</td>
							<td>
								<xsl:value-of select="laud/asukoht"/>
							</td>
							<td>
								<xsl:value-of select="laud/seisukord"/>
							</td>
							<td>
								<xsl:value-of select="tellimusestaatus"/>
							</td>
						</tr>
					</xsl:for-each>
				</table>

				<h2>Funktsioon 1: Näitame kõik tellimused, mis on valmis.</h2>
				<table border="1">
					<tr>
						<th>Tellimus ID</th>
						<th>Teenindaja nimi</th>
						<th>Teenindaja tunnus</th>
						<th>Toit</th>
						<th>Jook</th>
						<th>Laua Number</th>
						<th>Laua Mahutavus</th>
						<th>Laua Asukoht</th>
						<th>Laua Seisukord</th>
						<th>Tellimuse Staatus</th>
					</tr>
					<xsl:for-each select="restoran/tellimus[tellimusestaatus='Valmis']">
						<tr>
							<td>
								<xsl:value-of select="tellimusId"/>
							</td>
							<td>
								<xsl:value-of select="teenindaja/nimi"/>
							</td>
							<td>
								<xsl:value-of select="teenindaja/tunnus"/>
							</td>
							<td>
								<xsl:value-of select="menu/toit"/>
							</td>
							<td>
								<xsl:value-of select="menu/jook"/>
							</td>
							<td>
								<xsl:value-of select="laud/number"/>
							</td>
							<td>
								<xsl:value-of select="laud/mahutavus"/>
							</td>
							<td>
								<xsl:value-of select="laud/asukoht"/>
							</td>
							<td>
								<xsl:value-of select="laud/seisukord"/>
							</td>
							<td>
								<xsl:value-of select="tellimusestaatus"/>
							</td>
						</tr>
					</xsl:for-each>
				</table>

				<h2>Funktsioon 2: Valmis tellimused värvime roheliseks ja ei ole valmis värvime punaseks</h2>
				<table border="1">
					<tr>
						<th>Tellimus ID</th>
						<th>Teenindaja nimi</th>
						<th>Teenindaja tunnus</th>
						<th>Toit</th>
						<th>Jook</th>
						<th>Laua Number</th>
						<th>Laua Mahutavus</th>
						<th>Laua Asukoht</th>
						<th>Laua Seisukord</th>
						<th>Tellimuse Staatus</th>
					</tr>
					<xsl:for-each select="restoran/tellimus">
						<tr>
							<td>
								<xsl:value-of select="tellimusId"/>
							</td>
							<td>
								<xsl:value-of select="teenindaja/nimi"/>
							</td>
							<td>
								<xsl:value-of select="teenindaja/tunnus"/>
							</td>
							<td>
								<xsl:value-of select="menu/toit"/>
							</td>
							<td>
								<xsl:value-of select="menu/jook"/>
							</td>
							<td>
								<xsl:value-of select="laud/number"/>
							</td>
							<td>
								<xsl:value-of select="laud/mahutavus"/>
							</td>
							<td>
								<xsl:value-of select="laud/asukoht"/>
							</td>
							<td>
								<xsl:value-of select="laud/seisukord"/>
							</td>
							<td>
								<xsl:choose>
									<xsl:when test="tellimusestaatus='Valmis'">
										<span style="background-color: green; color: white;">
											<xsl:value-of select="tellimusestaatus"/>
										</span>
									</xsl:when>
									<xsl:when test="tellimusestaatus='Ei ole valmis'">
										<span style="background-color: red; color: white;">
											<xsl:value-of select="tellimusestaatus"/>
										</span>
									</xsl:when>
								</xsl:choose>
							</td>
						</tr>
					</xsl:for-each>
				</table>

				<h2>Funktsioon 3: Lisame veel üks rida, kus tähistame koht on väljas või sees</h2>
				<table border="1">
					<tr>
						<th>Tellimus ID</th>
						<th>Teenindaja nimi</th>
						<th>Teenindaja tunnus</th>
						<th>Toit</th>
						<th>Jook</th>
						<th>Laua Number</th>
						<th>Laua Mahutavus</th>
						<th>Laua Asukoht</th>
						<th>Laua Seisukord</th>
						<th>Tellimuse Staatus</th>
						<th>Asukoht</th>
					</tr>
					<xsl:for-each select="restoran/tellimus">
						<tr>
							<td>
								<xsl:value-of select="tellimusId"/>
							</td>
							<td>
								<xsl:value-of select="teenindaja/nimi"/>
							</td>
							<td>
								<xsl:value-of select="teenindaja/tunnus"/>
							</td>
							<td>
								<xsl:value-of select="menu/toit"/>
							</td>
							<td>
								<xsl:value-of select="menu/jook"/>
							</td>
							<td>
								<xsl:value-of select="laud/number"/>
							</td>
							<td>
								<xsl:value-of select="laud/mahutavus"/>
							</td>
							<td>
								<xsl:value-of select="laud/asukoht"/>
							</td>
							<td>
								<xsl:value-of select="laud/seisukord"/>
							</td>
							<td>
								<xsl:value-of select="tellimusestaatus"/>
							</td>
							<td>
								<xsl:choose>
									<xsl:when test="laud/asukoht='B'">Väljas</xsl:when>
									<xsl:otherwise>Sees</xsl:otherwise>
								</xsl:choose>
							</td>
						</tr>
					</xsl:for-each>
				</table>
				
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>
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

				<h2>Toidud</h2>
				<table border="1">
					<tr>
						<th>Nimi</th>
						<th>Hind</th>
						<th>Kategooria</th>
					</tr>
					<xsl:for-each select="restoran/menu/toit">
						<tr>
							<td>
								<xsl:value-of select="nimi"/>
							</td>
							<td>
								<xsl:value-of select="hind"/>
							</td>
							<td>
								<xsl:value-of select="kategooria"/>
							</td>
						</tr>
					</xsl:for-each>
				</table>

				<h2>Joogid</h2>
				<table border="1">
					<tr>
						<th>Nimi</th>
						<th>Hind</th>
						<th>Kategooria</th>
					</tr>
					<xsl:for-each select="restoran/menu/jook">
						<tr>
							<td>
								<xsl:value-of select="nimi"/>
							</td>
							<td>
								<xsl:value-of select="hind"/>
							</td>
							<td>
								<xsl:value-of select="kategooria"/>
							</td>
						</tr>
					</xsl:for-each>
				</table>

				<h2>Lauad</h2>
				<table border="1">
					<tr>
						<th>Laua number</th>
						<th>Mahutavus</th>
						<th>Koht</th>
						<th>Seisukord</th>
					</tr>
					<xsl:for-each select="restoran/laud">
						<tr>
							<td>
								<xsl:value-of select="number"/>
							</td>
							<td>
								<xsl:value-of select="mahutavus"/>
							</td>
							<td>
								<xsl:value-of select="asukoht"/>
							</td>
							<td>
								<xsl:value-of select="seisukord"/>
							</td>
						</tr>
					</xsl:for-each>
				</table>

				<h2>Teenindajad</h2>
				<table border="1">
					<tr>
						<th>Teenindaja nimi</th>
						<th>Teenindaja number</th>
					</tr>
					<xsl:for-each select="restoran/teenindaja">
						<tr>
							<td>
								<xsl:value-of select="nimi"/>
							</td>
							<td>
								<xsl:value-of select="tunnus"/>
							</td>
						</tr>
					</xsl:for-each>
				</table>

				<h2>Tellimused</h2>
				<table border="1">
					<tr>
						<th>Id</th>
						<th>Teenindaja</th>
						<th>Tellimusestaatus</th>
					</tr>
					<xsl:for-each select="restoran/tellimus">
						<tr>
							<td>
								<xsl:value-of select="id"/>
							</td>
							<td>
								<xsl:value-of select="teenindaja"/>
							</td>
							<td>
								<xsl:value-of select="tellimusestaatus"/>
							</td>
						</tr>
					</xsl:for-each>
				</table>

				<h2>Funktsioon 1. Kui tellimus on valmis - määrame seda roheliseks, kui ei ole valmis - punaseks.</h2>
				<table border="1">
					<tr>
						<th>Id</th>
						<th>Teenindaja</th>
						<th>Tellimusestaatus</th>
					</tr>
					<xsl:for-each select="restoran/tellimus">
						<tr>
							<td>
								<xsl:value-of select="id"/>
							</td>
							<td>
								<xsl:value-of select="teenindaja"/>
							</td>
							<td>
								<xsl:choose>
									<xsl:when test="tellimusestaatus = 'Valmis'">
										<span style="color: green;">
											<xsl:value-of select="tellimusestaatus"/>
										</span>
									</xsl:when>
									<xsl:otherwise>
										<span style="color: red;">
											<xsl:value-of select="tellimusestaatus"/>
										</span>
									</xsl:otherwise>
								</xsl:choose>
							</td>
						</tr>
					</xsl:for-each>
				</table>

				<h2>Funktsioon 2. Kui hind joogile on suurem kui 3, siis joogid on kallid.</h2>
				<table border="1">
					<tr>
						<th>Nimi</th>
						<th>Hind</th>
						<th>Kategooria</th>
						<th>Odav/Kalli</th>
					</tr>
					<xsl:for-each select="restoran/menu/jook">
						<tr>
							<td>
								<xsl:value-of select="nimi"/>
							</td>
							<td>
								<xsl:value-of select="hind"/>
							</td>
							<td>
								<xsl:value-of select="kategooria"/>
							</td>
							<td>
								<xsl:choose>
									<xsl:when test="hind &gt; 3">
										kallis
									</xsl:when>
									<xsl:otherwise>
										odav
									</xsl:otherwise>
								</xsl:choose>
							</td>
						</tr>
					</xsl:for-each>
				</table>

				<h2>Funktsioon 3. Määrame värvid toidu kategooriatele</h2>
				<table border="1">
					<tr>
						<th>Nimi</th>
						<th>Hind</th>
						<th>Kategooria</th>
					</tr>
					<xsl:for-each select="restoran/menu/toit">
						<tr>
							<td>
								<xsl:value-of select="nimi"/>
							</td>
							<td>
								<xsl:value-of select="hind"/>
							</td>
							<td>
								<xsl:choose>
									<!--Külmad suupisted-->
								<xsl:when test="kategooria = 'Külmad suupisted'">
									<span style="color: cyan;">
										<xsl:value-of select="kategooria"/>
									</span>
								</xsl:when>
									<!--Soojad suupisted-->
									<xsl:when test="kategooria = 'Soojad suupisted'">
										<span style="color: orange;">
											<xsl:value-of select="kategooria"/>
										</span>
								</xsl:when>
									<!--Supid-->
								<xsl:when test="kategooria = 'Supid'">
									<span style="color: yellow;">
										<xsl:value-of select="kategooria"/>
									</span>
								</xsl:when>
									<!--Salatid-->
								<xsl:when test="kategooria = 'Salatid'">
									<span style="color: lime;">
										<xsl:value-of select="kategooria"/>
									</span>
								</xsl:when>
									<!--Pearoad-->
									<xsl:when test="kategooria = 'Pearoad'">
										<span style="color: burlywood;">
											<xsl:value-of select="kategooria"/>
										</span>
									</xsl:when>
									<!--Grill-->
									<xsl:when test="kategooria = 'Grill'">
										<span style="color: coral;">
											<xsl:value-of select="kategooria"/>
										</span>
									</xsl:when>
									<!--Magustoidud-->
									<xsl:when test="kategooria = 'Magustoidud'">
										<span style="color: pink;">
											<xsl:value-of select="kategooria"/>
										</span>
									</xsl:when>
								<xsl:otherwise>
									<span style="color: gold;">
										<xsl:value-of select="kategooria"/>
									</span>
								</xsl:otherwise>
							</xsl:choose>
							</td>
						</tr>
					</xsl:for-each>
				</table>

				<h2>Funktsioon 4. Lisame üks rida, kus hind on vähem kui 6 siis toit on odav, kui 10 siis kallis ja kõik teised on väga kallid</h2>
				<table border="1">
					<tr>
						<th>Nimi</th>
						<th>Hind</th>
						<th>Kategooria</th>
						<th>Hinna kategooria</th>
					</tr>
					<xsl:for-each select="restoran/menu/toit">
						<tr>
							<td>
								<xsl:value-of select="nimi"/>
							</td>
							<td>
								<xsl:value-of select="hind"/>
							</td>
							<td>
								<xsl:value-of select="kategooria"/>
							</td>
							<td>
								<xsl:choose>
									<xsl:when test="hind &gt; 10">
										kallis
									</xsl:when>
									<xsl:when test="hind &gt; 6">
										odav
									</xsl:when>
									<xsl:otherwise>
										väga kallis
									</xsl:otherwise>
								</xsl:choose>
							</td>
						</tr>
					</xsl:for-each>
				</table>

			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>
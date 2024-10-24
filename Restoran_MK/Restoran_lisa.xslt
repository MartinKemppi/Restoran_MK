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
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>
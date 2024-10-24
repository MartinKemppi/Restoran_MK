﻿<%@ Page Title="Home Page" Language="C#" AutoEventWireup="true" CodeBehind="Default.aspx.cs" Inherits="Restoran_MK._Default" %>

<!DOCTYPE html>
<html>
    <head>
        <title>Pirasmani - restoran</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <div>
            <asp:Xml runat="server" DocumentSource="~/Restoran.xml"
                TransformSource="~/Restoran_lisa.xslt"/>
        </div>
    </body>
</html>

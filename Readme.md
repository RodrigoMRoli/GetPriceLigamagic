# Get Price Ligamagic

This is a simple API for live price checking on collectables. More specific Magic The Gathering cards. The objectice is to bring the desired values into a database and from this point further manipulate these numbers as you want, as: compare prices with other companies, analyse data for statistics, speculation, etc.

My main personal objective was creating this API that works as practical and simple as it can. That's the sole reason you can only check with this specific collection with the API. 

Being requested in the future, to add more functions to expand the project. I'd gladly do it. However, at the moment I consider my mission complete. Because adding more functions and expanding the project would be investing more time at hard coding than actual logical challenge. As these informations is already in the API, it just ignore those. 

# Required Setup

You'll need to:
- Have a local host or a server that runs SQL Server and PHP
- Import the data "ixalan.csv" into your server.

# How does it work?

Well, the API checks for specifics collection on the website provided by it's ID. i.e.: In this case, the collection we're looking for is "Ixalan" which was made in this link: [Ixalan's Collection](https://www.ligamagic.com.br/?view=colecao/colecao&id=6197 "Ixalan's Collection"). 

From there it gets the values and save in the server.

# Run

- Download the files in your server then open the page. 
- Import the "ixalan.csv" into your SQL Server
- Open the link /getPriceLigamagic.php
- Now check the price of each card being filled in your server
How to run the Vending Machine Project
1. Download the  zip file

2. Extract the file and copy nestaway folder

3. Paste inside root directory(for xampp xampp/htdocs, for wamp wamp/www, for lamp var/www/html)

4. Open PHPMyAdmin (http://localhost/phpmyadmin)

5. Create a database with name vending_machine

6. Import vending_machin.sql database file (given inside the package in SQL file folder)

7.Import the Postman Collection of APIs using link:
https://www.getpostman.com/collections/322815853929801e9c1e

8.Run all the 6 APIs:
a) allBeverages : Get list of all beverages present in the vending machine
b) allIngredients : Get list of all ingredients present in vending machine to make beverages.
c) beverageNameById : Get the beverage name from its id.
	- input : (beverage id)
d) refill : Refills the vending machine ingredients upto the quantity you want.
	 - input : {"name of ingredient" : "quantity upto which you want to fill that ingredient"}
e) order : Order the beverage of your choice from the given choices ( 1 to 4 )
	input :  (beverage id)

f) ingredientsOfBeverage : Get all the ingredients and their amount required to make a particular beverage.
	- input : (beverage id)
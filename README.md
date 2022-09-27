# Ecommerce-site
Ecommerce site built on PHP designed to allow fro trading of properties amongst users
   


Documetation below
README for DB manipulation files


$$Login.html - has form for logging into the system. 

inputs 

- username

- password (immediately encrypted)

posts to

- posts to conn2.php for verification 


$$conn2.php - uses posted username to retrieve encrypted password, which is
        compared to verify/reject the login.


$$register.html - provides form for individual to register. 

inputs

- username

- password

- confirmation password

- first name

- last name

- email address

- phone number

- type of user (buyer/seller/administrator)
 
posts to

- connect.php for saving info to DB


$$connect.php - stores posted information into the user table.

$$add_property.html - accepts property information to create property record

inputs

-  owner (numeric)
 
-  name (property name)
 
-  st_address   (street address of property)
  
-  city
	 
-  state
	
-  zip
	
-  build_date 
	
-  sq_footage
  
-  num_bedrooms

-  num_baths

-  price

-  picture  (name of picture file)
 
posts to

- add_property.php


$$add_property.php - saves property information into the properties table


$$edit_property.html - accepts property id of property to be edited

inputs

- property id  (numeric)

posts to

- edit_property.php


$$edit_property.php - uses property id to retrieve property information, which
	is used to populate a generated Form.

inputs

- property id

DB inputs

- owner (numeric)

- name (property name)

- st_address   (street address of property)

- city

- state

- zip
	
- build_date 

- sq_footage

- num_bedrooms

- num_baths
	
- price

- picture  (name of picture file)

posts to

- update_property.php

$$update_property.php - saves/updates data to the properties table.

$$listusers.php - utility file that displays contents of the users table.

$$listproperties.php - utility file that displays contents of the properties table.

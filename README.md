#Laravel API Docs

API is simple internship management system.

**Authentification**
API is using Sanctum authentication.
So it should look like this
--
Bearer API_KEY
--

**Headers**
Follow this pattern:
Accept: application/json

###Endpoints

There are:

######Login Endpoint /api/login
It accepts **POST** request.
Request(application/json):
mail : YOUR_MAIL
password: YOUR_PASSWORD

######Users endpoint(Users resource)

**Get all users /api/Users** **[GET]**

This endpoint will allow you to get the users registered in the system.
Request: /
Response: 200,(application/json)

**Create user/api/Users** **[POST]**

This endpoint will allow you to create user in the system.
Request: (application/json)
Response: 200(application/json)

**Get specific user /api/Users/{id}** **[GET]**

This endpoint will allow you to get a single user.
Parameter:{id} User id
Request: /
Response: (application/json)

**Update user /api/Users/{id}** **[PUT]**

This endpoint will allow you to update the user's information.
Parameter:{id} User id
Request: (application/json)
Response: (application/json) - returns updated user's info.

**Delete user /api/Users/{id}** **[DELETE]**

This endpoint will allow you to delete specific user.
Parameter:{id} User id
Request: /
Response: 200(application/json,1 if success, 0 for not)
######Interns
######Assignments
######Review
######Groups

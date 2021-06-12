

## About InTern Test App

Intern test app is a RESTAPI application writern in laravel framework. Passport is used as the Authentication of the RESTAPI, it performs the following:

- [Register a user].
- [Update the user's details].
- [Fetch the user's details].
- [Delete the use].
- [Login the user].

Intern Test App has auth:api middleware for the update, fetch and delete which only gets the login user.

## Endpoint 

The endpoint on the app are:
- POST      | api/login 
- POST      | api/register 
- DELETE    | api/user/{user} 
- PUT|PATCH | api/user/{user}
- GET|HEAD  | api/user/{user}  

And other routes added by passport

## Workflow

- Registeration: successfully returns a token which can be used without login to the system considering that the user just registered and is redirected to the app.
- Login: successfully returns a token which can now be used to perform other actions like geting the user, updating the user and deleting the user
- Delete: this removes the user and returns it so that it can be seen by the frontend but once refreshed the user is throw out of the system.
- Update: checks if the user made any changes, it also has some validation which are not required expect found in the request. when Successful it returns the users new information


## Some Known Vulnerabilities

when the wrong route is entered for a proteched endpoint the app crashes looking for the login Route 

## License

The Intern RESTAPI open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

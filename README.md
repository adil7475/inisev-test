## About Inisev Test
### How to make it working
- Clone the repository.
- Go to project folder.
- Run composer install to install to required dependencies.
- Run "php artisan db:seed". It will create 10 user and 5 websites and link every user to every website.
- Configure Email STMP for sending For example configure Mailtrap.
- Add 'database' as a Queue driver. Change the value of QUEUE_DRIVE="Database".

### Note:
- There are many improvements we can do in this code which may required more time to like For example we can use Repository
Patterns etc.
- Postman collection for API's has been added in the root directory name Postman

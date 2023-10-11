# I have attached  the Postman collection
[PostMan Collection](https://github.com/Mahmoud-kamal12/robusta/blob/main/robusta.postman_collection.json)
# To Start The Project

- Rename .env.example To .env
- ```composer install```
- ```php artisan migrate --seed```
- ```php artisan serve```
- Take any user email from the database and the password for all is ```password```
- Login in Postman then use APIs

# Notes
    - In this task, I did not create a admin panel, and this is because I think it is not necessary , as it is mentioned at the end of the PDF file that it is a API.

    - I did not add crud to add, delete or modify the bus or the city and the trips are available for add only, considering that they are sub-parts and not important. The greatest focus was on Writing an algorithm to add reservations

## Laravel Scrapper

Project in Laravel 5.0.0 to scrape an external page and extract information about it.


## Instructions

1 - Clone/download the repository. 
Command to use : git clone https://github.com/JPGSP/Scrapper.git TestScrapper
2 - Once the project has been downloaded, it is necessary to update the composer. 
Inside our folder TestScrapper, use command: composer update.
3 - Install all the dependencies of the project.
Inside out folder TestScrapper, use command: composer install.
4 - When the execution of the previos command has finished, we are ready to use our TestScrapper project.
Use the command php artisan serve to run our project on the address localhost:8000.

## Information

This project has a main page with information about the author and one button.
At the moment the button is pressed, the scrape of an external page (harcode url) starts.
When the application collects the information, it downloads in a json file inside the public directory folder json and it shows the information in a result page.

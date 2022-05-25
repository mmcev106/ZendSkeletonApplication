# githubapi
Application to pull the most starred PHP projects from Github
Steps you need to setup the githubapi
1. you will need to set up 2 folders 
2. c:\devroot\webpages and c:\devapps
3. in the webpages folder you will copy the entire githubapi into the folder called githubapp
4. in the devapps folder you will download php 7.4 and copy it into a folder called php
5. next thing you will need is to set up IIS, you can follow the instructions in this link
6. https://www.how2shout.com/how-to/how-to-install-iis-web-server-on-windows-10-step-by-step.html
7. and when you're done the link you will go to should be 
8. http://localhost/githubapp/public/index.php/
9. create a mysql table with the username root and password test 
10. then create a table called gitData as follows
    CREATE TABLE gitData (
    id int NOT NULL AUTO_INCREMENT,
    git_id varchar(255),
    full_name varchar(255),
    url varchar(255),
    created_date varchar(255),
    last_push_date varchar(255),
    project_description varchar(255),
    number_of_stars varchar(255),
    PRIMARY KEY (id)
    );
12. please let me know if you have any questions or issues setting it up
13. 
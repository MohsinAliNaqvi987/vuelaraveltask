Instructions to run this project:

1. From XAMPP Control Panel start APACHE and MySQL.
2. After cloning the repo, go to the "vuelaraveltask" folder by running cd "vuelaraveltask"
   in your editor terminal.
3. Then run command "composer install" in the folder "vuelaraveltask".
4. Then run command "npm install" in the folder "vuelaraveltask".
5. Then if using Linux, run command "cp .env.example .env" and if
   using Windows, run command "copy .env.example .env" (in the folder "vuelaraveltask").
6. Then generate app key by running command "php artisan key:generate" (in the folder "vuelaraveltask"). 
7. You have to create your own Google O-auth client id to check Google Authentication.
8. For that, go to Google Developers Console and create a New Project.
9. Give it any name and click create.
10. Then go to Credentials tab on left side and then click Create Credentials and choose OAuth client Id.
11. After that it will ask you to Configure Conscent Screen click on that button.
12. Choose External User Type from there and click Create.
13. Then OAuth Conscent Screen will appear.
14. Give any name in App name and give email address (also in provide Developer Contact information email address.)
15. Click on Save and Continue.
16. In Scopes screen click on Add Or Remove Scopes.
17. Choose first three scopes.
    .../auth/userinfo.email	
    .../auth/userinfo.profile
    openid
    and click on Update.
18. Then Click on Save and Continue.
19. In Test Users screen directly click on Save and Continue.
20. Then on Summary Screen click on Back to Dashboard.
21. Then again from Credentials tab click on Create Credentials and choose OAuth client Id.
22. Select Application type as Web Application.
23. And click on Add Url Button in Authorised JavaScript origins
24. And provide "http://localhost:8000" there and then click Create button.
25. Your Client Id will be created. Copy this Client Id and paste in the below files.
    With in Data variables names "params"
        Signup.vue Line Number 48.
        Login.vue Line Number 39. 
26. Then run "php artisan serve" and in the browser go to localhost:8000 (in the folder "vuelaraveltask").

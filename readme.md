***
#  🌸 Mailing Labels Generator 🌸
---


![GitHub commit activity](https://img.shields.io/github/commit-activity/m/Svendolin/mailing-label-generator?style=for-the-badge) ![GitHub contributors](https://img.shields.io/github/contributors/svendolin/mailing-label-generator?style=for-the-badge) ![GitHub forks](https://img.shields.io/github/forks/Svendolin/mailing-label-generator?color=pink&style=for-the-badge) ![GitHub last commit](https://img.shields.io/github/last-commit/Svendolin/mailing-label-generator?style=for-the-badge) ![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/Svendolin/mailing-label-generator?color=yellow&style=for-the-badge)
***
Ettikator, the mailing labels generator should contain:

* Used OOP and PDO, MVC principle and asynchronal requests via AJAX
* A database that contains all relevant data (e.g. user data, articles, page content, etc.).
* Two seperate Layouts or functionabiulities for unregistred as well as registred users
* A login form that registered users can use to log in. Once a user is logged in, they should be able to edit data in the database in an ASYNCHRONAL WAY and SERVERSIDE CONTENT
* A registration form that unregistered users can use to log in. This form should require at least four fields to be filled in and validated correctly (e.g. username, password,
E- mail address, last name, first name, etc.).
* Implementing a safe datatransfer and prepare statements

Optional stuff:

* "Forgot Password"
* E-Mail validation with your fitting email of your registered accounnt
* Search function
* Chatbot
* App with a full MVC-Model


<span style="color:orange"> (Tasks and requirements are based on the SAE Institute Zurich)</span> 

<br />
<br />

***
## Label-Generator (Explenation) 💬
***

Me and my mother run and host a web shop together and print out the labels myself, either directly at the post office (official website for online packaging) or with a "postal parcel addresser". So far we have used an outdated site: 
https://ignaz.ch/paket/ettikette/index.php - The idea now is to set it up like this, but with a login system where you can save the addresses and choose from a few designs. There are comparatively few good sites that fit this bill: so this project is THE ultimate chance for a massive improvement!



<br />
<br />

***
## Site explanation: ☑
***

HOME (index.php):

* Overview of events, news about the owner's vehicle and featured blogposts where the latest and most popular posts are loaded.
* ``IMPORTANT: (Password / Username / Email of the regstered users are stored at .gitignore)``

<br />
<br />



***
## Database Design (Explenation) 💬
***

Each user should provide the following information via registration form in order to register:
- Surename and Familyname
- Username (Shown in Blogposts, as well as publishing date)
- Vehicle (Car Brand, Model, Year)
- Image of the vehicle
- Place of residence (Canton only)
- Email address 
- Password
- Password Repeat

(Users can write and edit blogs while they are registrated and logged in)

(Users can watch blogs while they aren't registrated and also logged out)

(Admin should be able to edit and delete blog posts)

(Admin should be able delete users)

<br />
<br />

***
## PHP-Concept (Explenation) 💬
***


|Folder   |Content  |
| ---   | ---   |
|admin| Admin area (index.php) to delete and modify user profiles (user.php) and blogposts (blogposts.php) |
|guidesSAE| Summatives- und Formatives Assignment von diesem Modul |
|ignazstuff | HTML von Ignaz, einer Etikettenmusterseite, die mich überhaupt auf die Idee für dieses Projekt brachte|
|favicon| Favicon Symbole für verschiedene Devices|
|images|Bilder und Etiketten-Designs|
|includes| Laufendes Script, was der User nicht sehen wird: All inc files concerning included header and footer (html), database config (config.php) and mysql connections(mysql-connect.php) as well as functions (functions.inc.php) for the login and signup|
|passwordstuff| Passwords and usernames to login with the matching profile|
|themes|Beinhaltet alle CSS-Ordner mit Styles sowie einen Javascript Ornder für...|
|index.php| Startseite |
|logreg.php| Unterseite, wo sich der User registrieren und einloggen kann |
|menu.php| Unterseite im eingeloggten Zustand, um Adresslisten zu verwalten | 
|logout.php| Bereich um die eingeloggte Session zu zerstören |
|post.php| Full review of a selected blogpost matching with their ID|
|ettikator.sql| Exportierte Datenbank |


<br />
<br />

***
## License
***
[MIT](https://choosealicense.com/licenses/mit/) 🟢✔

<br />
<br />

***

## Technologies ✅
***
 Please make sure to update the CDNJS links from time to time
* [CDNJS](https://cdnjs.com/) : Used to link at JQuery, Fontawesome, GSAP
* [GOOGLE FONTS](https://cdnjs.com/) : Used for my fonts

<br />
<br />

***
## FAQs ✅
***
0 Questions have been asked, 0 answers have been given, 0 changes have additionally been made.

| Questions | Anwers | Changes |
|:--------------|:-------------:|--------------:|
| 0 | 0 | 0 |
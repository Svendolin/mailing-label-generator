***
#  📩 Mailing Labels Generator 📩
---


![GitHub commit activity](https://img.shields.io/github/commit-activity/m/Svendolin/mailing-label-generator?style=for-the-badge) ![GitHub contributors](https://img.shields.io/github/contributors/svendolin/mailing-label-generator?style=for-the-badge) ![GitHub forks](https://img.shields.io/github/forks/Svendolin/mailing-label-generator?color=pink&style=for-the-badge) ![GitHub last commit](https://img.shields.io/github/last-commit/Svendolin/mailing-label-generator?style=for-the-badge) ![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/Svendolin/mailing-label-generator?color=yellow&style=for-the-badge)
***
⚫🔴🟡Side note: The whole project is commented in German⚫🔴🟡

Ettikator, the mailing labels generator should contain:

* Used OOP and PDO, MVC principle and asynchronal requests via AJAX
* A database that contains all relevant data (e.g. user data, articles, page content, etc.).
* Two seperate Layouts or functionabiulities for unregistred as well as registred users
* A login form that registered users can use to log in. Once a user is logged in, they should be able to edit data in the database in an ASYNCHRONAL WAY and SERVERSIDE CONTENT
* A registration form that unregistered users can use to log in. This form should require at least four fields to be filled in and validated correctly (e.g. username, password,
E- mail address, last name, first name, etc.).
* Implementing a safe datatransfer and prepared statements.

Optional stuff:

* "Forgot Password"
* E-Mail validation with your fitting email of your registered accounnt
* Search function
* Chatbot
* App with a full MVC-Model


MUST ADD for alerts:
https://sweetalert.js.org/guides/#installation


<span style="color:orange"> (Tasks and requirements are based on the SAE Institute Zurich)</span> 

<br />

***
## Label-Generator (Explenation) 💬
***

Me and my mother run and host a web shop together and print out the labels myself, either directly at the post office (official website for online packaging) or with a "postal parcel addresser". So far we have used an outdated site: 
https://ignaz.ch/paket/ettikette/index.php - The idea now is to set it up like this, but with a login system where you can save the addresses and choose from a few designs. There are comparatively few good sites that fit this bill: so this project is THE ultimate chance for a massive improvement!

Quick overview what I've integrated in our project:

- The user can register and log in. Error messages are displayed on the server side via php (Registration / Login). All other messages should pop up on the client side via "Sweet Alert"!

- Once the user is logged in, he can keep his own address book and store addresses in his database

- When logged in, the user can access the GOOGLE MAPS API and GOOGLE MAPS GEOLOCATION (browse through the map or search addresses) asynchronously.

- CRUD statements are there to delete and edit addresses if necessary

- PHP is built in the OOP / MVC model and is clearly cast in sub- and superclasses and not procedural



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
## Database Design (Basic Structure to fill) 💬
***

```PHP

CREATE TABLE users (
    users_id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    users_uid varchar(128) NOT NULL,
    users_email varchar(128) NOT NULL,
    users_pwd varchar(128) NOT NULL 
);

```

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
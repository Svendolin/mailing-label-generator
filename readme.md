***
#  📩 Mailing Labels Generator 📩
---


![GitHub commit activity](https://img.shields.io/github/commit-activity/m/Svendolin/mailing-label-generator?style=for-the-badge) ![GitHub contributors](https://img.shields.io/github/contributors/svendolin/mailing-label-generator?style=for-the-badge) ![GitHub forks](https://img.shields.io/github/forks/Svendolin/mailing-label-generator?color=pink&style=for-the-badge) ![GitHub last commit](https://img.shields.io/github/last-commit/Svendolin/mailing-label-generator?style=for-the-badge) ![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/Svendolin/mailing-label-generator?color=yellow&style=for-the-badge)
***
⚫🔴🟡Side note: The whole project is commented in German⚫🔴🟡

[💯] 2nd Note: The described OOP / MVC / PDO processes are not summarized in the PDF but directly here in the readme.md markdown:


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


MUST ADD for alerts for future processes:
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
## Site- / Content explanation: ☑
***

**API**

* Google Maps and Google Geolocation API content
  * Google Maps Icons

**class**

* Super + subclasses regarding database, login, signup and menu

**favicon**

* Favicons for website

**guidesSAE**

* Summative / Formative Guidelines

**ignazstuff**

* Ignaz inspiration code

**images**

* Images used for the website
    * ettiketten-folder with 13 sample foils

**includes**

* included files regarding signup / login / logout / menu
    * html files (header / footer / label base for slider)

**node_modules**

* Node Package for print.js (For later use)

**guidesSAE**

* Summative / Formative Guidelines

**prefs**

* Credentials (database preferences)

**guidesSAE**

* Summative / Formative Leitlinien

**PW**

* Sensiblere Passwortdaten

**themes**

* More sensitive password data
    * css (designs for ettikator / mediaqueries / print for PDF / style (general style) / variables)

**.gitignore**

* Files, die von GIT ignoriert werden

**ettikator.sql**

* Exported etticator database

**index.php**

* Startdatei

**logreg.php**

* Anmelde- / Loginformular

**menu_bearbeiten.php**

* Menu File to edit addresses

**menu_update.php**

* Menu File to update the address

**menu.php**

* Menu File (Address Overview / Address Creation / Google Maps / Google Geolocation) 

**package.lock.json / package.json**

* JSON Packages

**readme.md**

* Readme Markdown (this file here xD)



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
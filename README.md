# Demo Project
@Author: Deepak Kuwor
@Dated: 27th July, 2022

@Title: This is a demo project for Interview.
@Description: Skill Test 
- " Create a registration page with details such as Name, DOB (Date of Birth), Mobile Number, Email Id, and Address and save it into a database".
- "Create a login page where the registered user can log in".


# NOTES: 
Project is build in basic code archictured without following Framework or market-demanding MVC architecture, for Interview Specific use.

However, a profession work should include following that is NOT incorporated in current work, for Demonstration Skill Test:
- Multiple Device (Desktop / Tablet / Mobile) Responsiveness
- Browser Testing
- User Input Validation
- Asynchronous Form Submission
- Use of Pattern
- Security (XSS Attack / SQL Injection / Reverse Directory Listing, etc.)


# Code Architecture
/@files:
    erd.sql     - Contains ERD for Database
/css:
    style.css   - Contains custom css for project
/img:
    avatar.png 
    favicon.ico
/template:
    header.php  - Header Template
    footer.php  - Footer Template

/config.php     - For MySQL Configuration
                - Registration Controller
                - Login Controller
/index.php      - Landing Page / Dashboard Page
/login.php      - Login Page
/register.php   - Registration Page
/logout.php     - Logout


# Code Setup:
- Create Database: `stlogin`
- Create Table: `users` (from @files/erd.sql)
- Run Apache/XAMPP/LAMPP/Nginx Server and access following URL:
    `http://localhost/st_login`
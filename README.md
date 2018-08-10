[![Build Status](https://travis-ci.org/vihd14/ramverk1-project.svg?branch=master)](https://travis-ci.org/vihd14/ramverk1-project)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/vihd14/ramverk1-project/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/vihd14/ramverk1-project/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/vihd14/ramverk1-project/badges/build.png?b=master)](https://scrutinizer-ci.com/g/vihd14/ramverk1-project/build-status/master)

# Project - the Home and Garden blog

Project in the web programming course "Webbaserade Ramverk 1".


## Install
Follow the steps below to install your own version of the site.

### Clone
Clone the git repository to a directory:
`git clone https://github.com/vihd14/ramverk1-project.git`

### Composer update
Assuming that you have `composer` installed, run composer update to install all necessary dependencies:
`composer update`

### Database
Use an SQLite database for this project and run the sql-code for the files in `sql/ddl/`.  
Insert the default users `doe/doe@dbwebb.se/doe` and `admin/admin@dbwebb.se/admin`.
Change in the file `config/database.php` to connect to your own database.

### .htaccess
Change the file `htdocs/.htaccess` to suit your own install.

## Styling
Feel free to change the style in `htdocs/css/style.css`. Observe that some views have styled components of their own, but most
styling is done in the css-file.

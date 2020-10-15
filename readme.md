### Chek PHP
The standard point when installing CMS is to check the requirements for PHP, which usually includes: checking the PHP version, the workability of some language functions, the presence of necessary and recommended extensions.<br>
After installation, the installer is removed, which is logical. But the life cycle of the application is just beginning, and here it is possible to install new components, errors caused by work on the hosting, change of hosting, etc. When encountering errors, it is important to know that PHP works as intended. Often this information needs to be searched, and not everyone succeeds in doing it promptly.<br>
The utility checks the requirements for PHP, the requirements themselves are collected in the `rules.json` file. In the repository, `rules.json` meets the requirements for [InstantCMS](https://instantcms.ru/) at the moment. Therefore, make changes to this file to suit your case before use.

## Usage
Place the contents of this repository on the server in the root directory of your site, for example, like this
``` bash
$ git clone https://github.com/navt/check-php.git
```
The directory `check-php` should appear in the root of the site. Edit `rules.json` according to your current task.<br>
In your browser, type `http://your-site.com/check-php/s.php`<br>
See the result. When finished, delete the `check-php` directory.
# Laravel Fixer

## Getting Started

This shell & php script show you if your Laravel version is compatible with PHP version and checks if all required modules are loaded.
Also its fixes laravel folders & files permissions

### Check php modules and version is possible from terminal. Why seperate PHP file to do it?

Not always terminal PHP version is the same with project PHP version. Calling PHP file we ensure that the right one PHP version is checked.

### Why do I need this?

With different web server configurations you may fall in problems by running Laravel framework. Missing modules can lead to very misleading errors. Sometimes you become no logs, no error displays or blank pages. Firstly what you need to do is to check basic configuration. This script can do it in few seconds. Also it fixes file & folder permissions.

### Installing

Download or clone it to Laravel project /public folder.

```
git clone https://github.com/grambas/laravel_fixer.git
```

Should like like below:
```
/path/to/laravel/public/laravel_check.php
/path/to/laravel/public/laravel_check.sh
```

Check if files are executable (if not: chmod og+x /path/to/laravel/public/laravel_check.sh)
Then run 
```
sh /path/to/laravel/public/laravel_checker.sh
```

Follow instructions in console...


## Demo
![Demo](https://github.com/grambas/laravel_fixer/blob/master/demo.png?raw=true)

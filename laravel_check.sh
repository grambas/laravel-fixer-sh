#!/bin/bash



echo "Start extension and php version test? (y/n)"
read test1

#################################################################
# Test if needed modules for Laravel is loaded
# Script will exit if laravel_check.php is not reachable.
#################################################################

if [ "$test1"  =  "y" ]; then

	echo "Enter your Laravel version? (ENTER)"
	read version

	echo  "Enter laravel_check.php URL (example.com/laravel_check.php) [ENTER]: "
	read url

	full_url=$(printf "%s%s%s" "$url" "?version=" "$version")

	echo "$full_url"
	content=$(curl -L -s $full_url )

	#read first 37characters and check if url is really check_laravel.php
	initial="$(echo $content | head -c 37)"

	if [ "$initial" != "########### LARAVEL CHECK ###########" ]; then
		echo "[ERROR] Check if you can reach $url"
		exit 0
	fi
	printf '%s' "$content"
fi


echo "\n\nStart file and folder permission fix? (y/n) (sudo needed)"
read test2
if [ "$test2"  !=  "y" ]; then
    echo "Exiting script..."
    exit 0
fi

echo  "Enter web server user [ENTER]: "
read name
echo "You have selected user: $name"
echo "Enter laravel main path [ENTER]: "
read  path
echo "You have selected path: $path"
echo "Please double check the input! Press n to cencel or y to agree and press [ENTER]"
read confirm


if [ "$confirm"  !=  "y" ]; then
    echo "Exiting script..."
    exit 0
fi

###################################################
# Fix File & Folder permissions
##################################################

echo "Running: sudo chown -R $name:$name $path/"
sudo chown -R "$name":"$name" "$path"/
echo "Done!"

echo "Running: sudo usermod -a -G $name root"
sudo usermod -a -G "$name" root
echo "Done!"

echo "Running: sudo find $path -type f -exec chmod 644 {} \;"
sudo find "$path" -type f -exec chmod 644 {} \;
echo "Done!"

echo "Running: sudo find $path -type d -exec chmod 755 {} \;"
sudo find "$path" -type d -exec chmod 755 {} \;
echo "Done!"

echo "Running: sudo chown -R $name:$name $path"
sudo chown -R "$name":"$name" "$path"
echo "Done!"

echo "Running: sudo find $path -type f -exec chmod 664 {} \;"
sudo find "$path" -type f -exec chmod 664 {} \;
echo "Done!"

echo "Running: sudo find $path -type d -exec chmod 775 {} \;"
sudo find "$path" -type d -exec chmod 775 {} \;
echo "Done!"

echo "Running: sudo chgrp -R $name storage bootstrap/cache"
sudo chgrp -R "$name" "$path"/storage "$path"/bootstrap/cache
echo "Done!"

echo "Running: sudo chmod -R ug+rwx storage bootstrap/cache"
sudo chmod -R ug+rwx "$path"/storage "$path"/bootstrap/cache

echo "DONE!"


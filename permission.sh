sudo find . -type d -exec chmod 755 {} \;
sudo find . -type f -exec chmod 664 {} \;
sudo chmod -R 777 application/config/
sudo chmod -R 777 assets/dist/img
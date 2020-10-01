
#!/bin/bash

set -e;
echo "Chown to www-data"
chown -R www-data:www-data ./
echo "Create upload folder"
mkdir -p /app/assets/img/upload
echo "Chmod upload folder"
chmod -R 755 /app/assets/img/upload

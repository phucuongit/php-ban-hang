
#!/bin/bash

set -e;
echo "Create upload folder"
mkdir -p /app/assets/img/upload
echo "Chmod upload folder"
chmod -R 777 /app/assets/img/upload

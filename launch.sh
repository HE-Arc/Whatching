#!/bin/sh
echo "Killing container..."
docker kill devenv > /dev/null
echo "Removing container..."
docker rm devenv > /dev/null
echo "Building container..."
docker build -t dlm3-laravel . > /dev/null
docker run --name devenv -d -p 5000:5000 dlm3-laravel sh /opt/scripts/start.sh > /dev/null
echo "Container started. Access on http://localhost:5000"

#!/bin/sh

cd /web/frontend/ && npm install && npm run build

tail -f /dev/null

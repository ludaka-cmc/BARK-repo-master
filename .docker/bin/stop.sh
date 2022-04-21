#!/bin/bash
set -x

docker stop $(docker ps -aq)

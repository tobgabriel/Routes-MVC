EXITED_CONTAINERS="$(docker ps -aq -f status=exited)"
docker container rm -f "$EXITED_CONTAINERS"

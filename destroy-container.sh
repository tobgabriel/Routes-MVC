EXITED_CONTAINERS="$(docker ps -aq -f status=exited)"
echo "$EXITED_CONTAINERS"



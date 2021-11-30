IMAGE_NAME="php-apache-image"
CONTAINER_NAME="php-server-container"
docker build -t "$IMAGE_NAME" .
#echo ""
#echo "****************************************************************"
#echo "Imagem montada"
#echo "****************************************************************"
#echo ""
docker run -it \
	--name "$CONTAINER_NAME"\
	-p 80:80 \
	-v $(pwd)/app:/var/www/html/ \
	 "$IMAGE_NAME"

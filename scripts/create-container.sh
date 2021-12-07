#!/usr/bin/env bash
###########################################################################
#					Autor: Tiago de Oliveira Braga Gabriel
#					Data: 30/11/2021
#					Revisão: 04/12/2021
#_________________________________//_______________________________________

###########################################################################
#						create-container-sh
# 			Cria um container com porta nomeada e volume nomeado \
#			para o ambiente
#Versão:v1.0: Script de Processamento Básico
#Versão:v1.1: Inclusão de mensagens de uso e arquivo conf
#_________________________________//_______________________________________

###########################################################################
#						VARIÁVEIS DE AMBIENTE
#_________________________________//_______________________________________
CONFIG_FILE="./env.conf"
IMAGE_NAME="php-apache-image"
CONTAINER_NAME="php-server-container"
PORT=80
###########################################################################
#						CHAVES FLAG E MENSAGEM USO
#_________________________________//_______________________________________
HELP_MESSAGE="
	$0
	-h				Exibe mensagem de uso
	--help
	-v				Exibe Versão de programa
	--version
"
###########################################################################
#								PRÉ-PROCESSAMENTO
#_________________________________//_______________________________________

#RESOLUÇÃO DAS OPÇÕES
while test -n "$1";do
	case $1 in
		-h | --help)
			echo "$HELP_MESSAGE"
			exit 0
		;;
		-v | --version)
			echo $(grep '^#Versão' $0 | tail -1 | cut -d":" -f2)
			exit 0
		;;
		*)
			if test -f "$1";then
						FILE="$1"
			elif test -n "$1";then
						echo "Opção Inválida:$1"
						exit 1
			fi
		;;
	esac
shift
done

#PARSER CONF
while read LINHA;do
	#Ignora linhas em branco
	[ -z "$LINHA" ] && continue
	#Compara o primerio caractere com '#' e identifica\
	#que é um comentário não o utiliza
	[ "$(echo $LINHA | cut -c1)" = "#" ] && continue
	#Acessa os valore atentar para espaço após o - não \
	#apontar pro conteudo "$LINHA"
	set - $LINHA
	#coloca chave em minusculo para comparação
	chave=$(echo $1 | tr '[:upper:]' '[:lower:]')
	shift
	#despreza comentário
	valor=$(echo $* | cut -d"#" -f1)
	echo "+++-->$chave=$valor"
	case "$chave" in
		imagename)
			#TODO:colocar proteção para valores inapropriados
			IMAGE_NAME="$valor"
		;;
		containername)
			#TODO:colocar proteção para valores inapropriados
			CONTAINER_NAME="$valor"
		;;
		port)
			PORT="$valor"
		;;
		*)
			echo "Erro no Arquivo de Configuração"
			echo "Opção desconhecida $chave $valor"
			exit 1
		;;
	esac
done <"$CONFIG_FILE"
###########################################################################
#							PROCESSAMENTO
#_________________________________//_______________________________________
docker build -t "$IMAGE_NAME" .
echo "+++-->Imagem montada"
docker run -it \
	--name "$CONTAINER_NAME"\
	-p 80:"$PORT" \
	-v $( echo $(pwd) | sed -e s/\\/[^\\/]*$//)/app:/var/www/html/ \
	 "$IMAGE_NAME"

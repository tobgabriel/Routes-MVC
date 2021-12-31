# Projeto de estudo sobre Rotas para sistemas MVC.

Para mais Informações acesse o [blog](https://tobgabriel.github.io/).

## Tecnologias utilizadas
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/raspberrypi/raspberrypi-original.svg" width=" width="40" height="40"/>       <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original-wordmark.svg" width="40" height="40"/>        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" width="40" height="40" />       <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/composer/composer-original.svg" width="40" height="40" />     <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bash/bash-original.svg" width="40" height="40" />

## Como Utilizar
<p style='text-align:justify;'>Este projeto foi desenvolvido no Raspbian(armv7), para rodar um container mariadb compatível com a arquitetura do processador foi necessário utilizar a imagem alpine,tive problemas em realizar o pull da imagem.</p>
    > no matching manifest for linux/arm/v7 in the manifest list entries
<p style='text-align:justify;'>Para mais detalhes veja a subseção Tips.</p>

### Pré-Requisitos
* Docker Engine;

### Lição Ponto a Ponto
* 1)Usar /scripts/create-container.sh para criar o container do servidor apache,as variáveis de ambiente podem ser modificadas no arquivo env.conf
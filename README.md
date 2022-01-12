# Projeto de estudo sobre Rotas para sistemas MVC.

Para mais Informações acesse os posts [Rotas MVC](https://tobgabriel.github.io/) que descrevem o sistema.

## Tecnologias utilizadas
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/raspberrypi/raspberrypi-original.svg" width="40" height="40"/>       <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original-wordmark.svg" width="40" height="40"/>        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" width="40" height="40" />       <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/composer/composer-original.svg" width="40" height="40" />     <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bash/bash-original.svg" width="40" height="40" />

## Como Utilizar

### Pré-Requisitos
* Docker Engine;

### Lição Ponto a Ponto
* 1)Usar /scripts/create-container.sh para criar o container do servidor apache,as variáveis de ambiente podem ser modificadas no arquivo env.conf
* 2)Carregue as classes com o composer
    ~~~sh
    $ docker container exec NOME_DO_CONTAINER_APACHE bash composer dump-autoload
    ~~~
    
## FIX ME

* <p style='text-align:justify;'>Este projeto foi desenvolvido no Raspbian(armv7), para rodar um container mariadb compatível com a arquitetura do processador foi necessário utilizar a imagem alpine,tive problemas em realizar o pull da imagem.</p>

    > no matching manifest for linux/arm/v7 in the manifest list entries
* <p style='text-align:justify;'>Quando crio os arquivos pelo composer preciso alterar minhas permissões de usuário na máquina host para alterar os arquivos no volume nomeado.</p>
* Quando crio o container o apache retorna o erro [AH00558](https://do.co/32XccM2)

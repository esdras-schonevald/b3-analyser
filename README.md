# B3 Analyser
Um container colaborativo de inteligência artificial para análise de ativos da b3

## Como colaborar?
  - Faça um FORK do projeto, isto é, copiar o projeto para um repositório seu.
  - Crie a sua pasta dentro do repositório, e crie ou altere arquivos como quiser (dentro da sua pasta).
  - Faça um PULL REQUEST para que suas alterações façam parte do projeto original.

## Convidados
Se você recebeu um convite em seu e-mail e agora faz parte da equipe de desenvolvedores deste projeto, você pode baixar o git [neste link](https://git-scm.com) e após a instalação basta abrir o terminal (linux), prompt (windows) ou bash (mac) e seguir os seguintes passos:

  1.  Fazer uma cópia do repositório para o seu ambiente local

      >*git clone https://github.com/esdras-schonevald/b3-analyser.git*

  2.  Entrar na pasta onde foi salvo o projeto

      >*cd b3-analyser*

  3.  Iniciar o git nesta pasta

      >*git init*

  4.  Configurar nome e e-mail de usuário (o mesmo que você utiliza para acessar o github)

      >*git config --global user.name "seu-nome"*

      >*git config --global user.email "seu-email"*

  5.  Configurar o token de acesso. Para isso é necessário a criação do token de acesso no site do github.
      Caso você não saiba como criar o seu token de acesso [clique aqui](https://docs.github.com/pt/authentication/keeping-your-account-and-data-secure/creating-a-personal-access-token) e saiba mais.
      Após a criação do token utilize este token no lugar da senha *(obs.: senha não funciona, precisa realmente ser um token)*

      >*git config --global user.password "seu-token-de-acesso"*

  6.  Selecione a branche (para qual ambiente vão os seus commits) que irá utilizar. No nosso caso utilize **dev**

      >*git branch -M dev*

  7.  Adicione este repositório aos seus locais remotos

      >*git remote add origin https://github.com/esdras-schonevald/b3-analyser.git*

Pronto vocẽ já está com o repositório configurado. Agora siga os próximos passos a cada alteração que você for subir para o repositório:

  8.  Antes de subir qualquer alteração, atualize o seu repositório baixando as modificações feitas por outros desenvolvedores através do comando abaixo

      >*git pull*

  9.  Crie, altere e remova arquivos livremente. Para que o git crie uma lista com as alterações que você fez utilize

      >*git add .*

  10. Para consultar as alterações que estão na lista do git basta digitar

      >*git status*

  11. Uma vez que os seus arquivos já estejam na lista do git, é possível fazer um commit (que é a realização destas alterações no seu ambiente local). Uma boa prática é escrever uma mensagem explicando de uma maneira simples as alterações feitas

      >*git commit -m "descrição das alterações"*

  12. E finalmente utilize este ultimo comando para enviar as suas alterações locais para o repositório no servidor (neste caso o github)

      >*git push -u origin dev*
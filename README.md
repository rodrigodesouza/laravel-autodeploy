AUTODEPLOY //Ramo que deseja baixar atualizações; Padrão: production
AUTODEPLOY=production, developer, master...

# laravel-autodeploy
#Este documento está em desenvolvimento

Autodeploy de projetos em Laravel

OBS: AUTODEPLOY //Ramo que deseja baixar atualizações; Padrão: production AUTODEPLOY=production, developer, master...

GITLAB
Chaves RSA SSH
ssh-keygen -o -f ~/.ssh/id_rsa

Testar conexão com o gitlab: ssh -T git@gitlab.com

The authenticity of host 'gitlab.com (35.231.145.151)' can't be established.
ECDSA key fingerprint is SHA256:HbW3g8zUjNSksFbqTiUWPWg2Bq1x8xdGUrliXFzSnUw.
ECDSA key fingerprint is MD5:f1:d0:fb:46:73:7a:70:92:5a:ab:5d:ef:43:e2:1c:35.
Are you sure you want to continue connecting (yes/no)? yes

Warning: Permanently added 'gitlab.com,35.231.145.151' (ECDSA) to the list of known hosts.
Welcome to GitLab, @rd7.rodrigo!

.ssh/known_hosts
 git init 
 git remote add origin ....
 
xxxxxxx

acesse seu servidor por ssh
Ex: ssh usuario@192.168.0.1 

#Criar a chave ssh
#1:Passo 01
Na raiz do projeto, digite no terminal o comando, substituindo o email, pelo seu email registrado no perfil do github/gitlab: 
ssh-keygen -t rsa -b 4096 -C “meu-email@email.com.br“

Selecione o local onde deseja salvar a chave. Se apertar enter (sem escrever nada), ela será salva na sua pasta home, dentro da pasta: ~/.ssh/id_rsa.pub

Selecione uma senha, para adicionar uma camada extra de segurança para sua chave. Você só irá precisar lembrar desta senha quando desejar alterá-la. Não é necessário lembrar e escrever ela toda vez que fizer a autenticação automática.

Será perguntando novamente a senha, para confirmação.

Será gerado então uma impressão digital do seu computador/servidor (key fingerprint).

#PASSO 2: Copiar a chave SSH (SSH key) para seu GitHub / GITLAB
A impressão digital gerada (fingerprint) e mostrada na tela pode ser adicionada diretamente ao seu GitHub.

Para o GITLAB, você precisa acessar o arquivo id_rsa.pub, copiar todo seu interior e inserir na página de chaves. Digite o comando para mostrar na tela sua chave gerada:

cat  ~/.ssh/id_rsa.pub

O início da chave deve começar com ssh-rsa e terminar com o seu email escolhido.


....
Fonte: https://viniciuspaes.com/mac-osx/tutorial-criar-chave-ssh-key-gitlab-github-mac-osx-linux-ubuntu/

ou https://docs.gitlab.com/ce/ssh/README.html
#Adicionando a chave ao gitlab
Configurações -> Chaves SSH
Add an SSH Key

Cole a sua chave SSH pública, que geralmente é encontrada no arquivo '~/.ssh/id_rsa.pub' e começa com 'ssh-rsa'. Não use a sua chave SSH privada.


The authenticity of host 'gitlab.com (35.231.145.151)' can't be established.
ECDSA key fingerprint is SHA256:HbW3g8zUjNSksFbqTiUWPWg2Bq1x8xdGUrliXFzSnUw.
ECDSA key fingerprint is MD5:f1:d0:fb:46:73:7a:70:92:5a:ab:5d:ef:43:e2:1c:35.
Are you sure you want to continue connecting (yes/no)? yes
Warning: Permanently added 'gitlab.com,35.231.145.151' (ECDSA) to the list of known hosts.
Enter passphrase for key '/home/hugamazonia/.ssh/id_rsa': 

#passo 02


na raiz do seu site ou subdominio (acima no public) digite os comandos:
1 - [sitebeta@srv-bredi ~]$ git init
// Initialized empty Git repository in /home/hugamazonia/.git/
2 - [sitebeta@srv-bredi ~]$ git remote add origin git@gitlab.com:brediweb/hug.git
3 - [hugamazonia@srv-bredi ~]$ git pull origin production


<!-- The authenticity of host 'gitlab.com (35.231.145.151)' can't be established.
ECDSA key fingerprint is SHA256:HbW3g8zUjNSksFbqTiUWPWg2Bq1x8xdGUrliXFzSnUw.
ECDSA key fingerprint is MD5:f1:d0:fb:46:73:7a:70:92:5a:ab:5d:ef:43:e2:1c:35.
Are you sure you want to continue connecting (yes/no)?  -->

<!-- Warning: Permanently added 'gitlab.com,35.231.145.151' (ECDSA) to the list of known hosts.
Permission denied (publickey).
fatal: Could not read from remote repository.

Please make sure you have the correct access rights
and the repository exists. -->
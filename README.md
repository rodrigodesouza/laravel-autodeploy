A documentação está incomplete.
Entre em contato para receber as instruções corretas, se desejar.
rd7.rodrigo@gmail.com

https://packagist.org/packages/rodrigodesouza/laravel-autodeploy

AUTODEPLOY //branch que deseja baixar atualizações; Padrão: production
AUTODEPLOY=production, developer, master...
DEPLOY_DE=//branch de trabalho. padrão: master
DEPLOY_PARA=//branch para enviar o deploy. padrão production

comando para fazer um deploy:
php artisan deploy:push "mensagem do commit obrigatório" --to=//Opcional. coloque o nome do branch que deseja enviar este deploy. padrão: production

criando a chave ssh no gitlab

GITLAB 
https://docs.gitlab.com/ee/ssh/

1 - Gerar a chave SSH do tipo RSA

- ssh-keygen -o -t rsa -b 4096 -C "email@example.com" //pode er o e-mail do site para identificar a chave
Não coloque senha.

Your identification has been saved in /home/unioconsultorios/.ssh/id_rsa.
Your public key has been saved in /home/unioconsultorios/.ssh/id_rsa.pub.

2 - Agora, é hora de adicionar a chave pública recém-criada à sua conta do GitLab.
abra o arquivo id_rsa.pub
vi /home/unioconsultorios/.ssh/id_rsa.pub

no gitlab
Configurações -> Chave SSH

adicione a nov key

3 - Baixar projeto no servidor

http://www.unioconsultorios.com.br/api/webhook

AUTODEPLOY="producao"

bitbucketserver (em breve)
https://confluence.atlassian.com/bitbucketserver/creating-ssh-keys-776639788.html

##
# laravel-autodeploy
#Este documento está em desenvolvimento

Autodeploy de projetos em Laravel
...

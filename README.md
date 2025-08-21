# ddd-blog


make install && make start

make shell

bin/console doctrine:schema:create

bin/console doctrine:fixtures:load

You can get an article from : http://localhost:8080/article/get/1

You can create an article from : http://localhost:8080/article/create?title=Cocorico&content=Voici%20mon%20super%20article
You have to start the corresponding worker : ibn/console mes:cons --limit=100 (choose async)

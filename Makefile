dc := docker-compose
exec := $(dc) exec
webexec := $(exec) --user application -w /app
rwebexec := $(exec) --user root -w /app

status:
	$(dc) ps

up:
	$(dc) up -d

stop:
	$(dc) stop

down:
	$(dc) down

restart:
	$(dc) restart

start:
	$(dc) start

sh:
	$(webexec) web bash

rsh:
	$(rwebexec) web bash


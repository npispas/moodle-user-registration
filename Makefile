.PHONY: moodle

# Define commands
up:
	docker-compose up -d

down:
	docker-compose down

restart:
	docker-compose down && docker-compose up -d --build

status:
	docker ps

moodle:
	docker exec -it moodle bash

db:
	docker exec -it moodle_db bash

reset-password:
	docker exec -it moodle php /bitnami/moodle/admin/cli/reset_password.php

install-plugin:
	docker cp ./moodle/local/registration_form moodle:/bitnami/moodle/local/
	docker restart moodle

logs:
	docker-compose logs -f

clean:
	docker-compose down -v
	docker system prune -af
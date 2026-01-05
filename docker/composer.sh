#!/usr/bin/env bash
docker-compose exec app sh -c "cd //var/www/ && composer $@"

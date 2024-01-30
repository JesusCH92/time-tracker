# TIME TRACKER

Stack tecnologico: PHP(Symfony), MySQL, Nginx, Webpack

## Entorno Dockerizado

**Debes tener instalado Docker y Docker Compose en tu equipo.**

- [ ] Instalar la network de los contenedores en caso de no tenerla instalada antes:

```shell
docker network create app-network
```

- [ ] Levantar los contenedores:

```shell
docker-compose -p time-tracker up -d
```

- [ ] Acceder al contenedor de PHP:

```shell
docker exec -it php-fpm bash 
```

- [ ] Después de entrar al contenedor de php-fpm, ejecutar:

```shell
make deploy
```

## Acceso al sistema

Después de desplegar el proyecto correctamente, debe acceder al siguiente enlace

[`http://localhost:8080`](http://localhost:8080)

- [ ] Desde la linea de comandos, se puede iniciar una tarea:

```shell
php bin/console app.task_time_init --task_name="TASK 1"
```

- [ ] Desde la linea de comandos, se puede finalizar una tarea:

```shell
php bin/console app.task_time_stop --task_name="TASK 1"
```

- [ ] Desde la linea de comandos, se puede ver el resumen de las horas inputadas de una tarea:

```shell
php bin/console app.finished_task_times --task_name="TASK 1"
```
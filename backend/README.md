Instalar dependencias:
`composer install`

Iniciar servidor:
`php -S localhost:8000`

Archivo de base de datos:
`database/migration.sql`

Lista de Urls:

    Crear base de datos con las tablas necesarias:
        GET: `/migrations`

    Registrar 5 usuarios de pruebas:
        GET: `/seeders`

    Lista de usuarios registrados
        GET: `/users`

    Obtener la ultima transaccion realizada
        GET: `/transactions`
    
    Obtener el historial de todas las transacciones
        GET: `/transactions/historical`

    Registrar una nueva transaccion
        POST: `/transactions`
        JSON: ```
            {
                "transactions": [
                    {
                        "id": 1,
                        "total": 10,
                        "name": "Roderick"
                    },
                    {
                        "id": 2,
                        "total": 20,
                        "name": "Hellen"
                    }
                ]
            }
        ```

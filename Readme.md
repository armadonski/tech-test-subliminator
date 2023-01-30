# Tech test

## Requirements:
Create a Symfony (6.x) + Angular (13 or newer) application for orders management (using data from orders.json)

Requirements:

1. Write a console command to import orders from a json file and save them in db (use DoctrineORM)
2. Fetch orders from backend and show them in a <table>
3. Add pagination (10 orders/page)
4. Allow users to cancel an order (order.status = cancelled)
   An order can be cancelled only if has status="pending"

# How to run the application:

* Clone the repository.

* Install all dependencies. Docker - Make
* run the command ``make start-development`` to start the application
** Wait until all containers are ready
** Node is the slowest. You can watch its progress by running ``docker logs -f docker-node-1``
* run `make stop-development` to stop the application
* run `make import-orders` to import orders

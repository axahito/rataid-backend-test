Laravel based CRUD API as requested by RATA.id in order to pass the Technical Test for Software Engineer.

Tech Stack :

- Laravel 8.0 with packages :
- PHP 8.0
- Database : Mysql

Database Structure :

![erd](./erd.png?raw=true "Entity Relationship Diagram")

How to Use : 

1. Clone the repository
2. Run ```composer update```
3. Setup ENV variables
4. Run ```php artisan migrate``` and ```php artisan db:seed```
5. Run ```php artisan serve```
6. access ```localhost:8000/api``` using postman to test the endpoints.

API Endpoints :

- Item API :
    Retrieving item list
        method: GET
        endpoint : ```/item```
    
    Retrieving item by id
        method: GET
        endpoint : ```/item/{item_id}```

    Insert item to database
        method: POST
        endpoint : ```/item/store```
        form-data : {
            name: string,
            price: integer
        }

    Update item from database
        method: POST
        endpoint : ```/item/{item_id}/update```
        form-data : {
            name: string,
            price: integer
        }

    Delete item from database
        method: DELETE
        endpoint : ```/item/{item_id}```

- Customer API :
    Retrieving customer list
        method: GET
        endpoint : ```/customer```
    
    Retrieving customer by id
        method: GET
        endpoint : ```/customer/{customer_id}```

    Insert customer to database
        method: POST
        endpoint : ```/customer/store```
        form-data : {
            name: string,
            address: string
        }

    Update customer from database
        method: POST
        endpoint : ```/customer/{customer_id}/update```
        form-data : {
            name: string,
            address: string
        }

    Delete customer from database
        method: DELETE
        endpoint : ```/customer/{customer_id}```

- Invoice API :
    Retrieving invoice list
        method: GET
        endpoint : ```/invoice```
    
    Retrieving invoice by id
        method: GET
        endpoint : ```/invoice/{invoice_id}```

    Insert invoice to database
        method: POST
        endpoint : ```/invoice/store```
        form-data : {
            qty: integer,
            item_id: integer,
            customer_id: integer
        }

    Update invoice from database
        method: POST
        endpoint : ```/invoice/{invoice_id}/update```
        form-data : {
            qty: integer,
            item_id: integer,
            customer_id: integer
        }

    Delete invoice from database
        method: DELETE
        endpoint : ```/invoice/{invoice_id}```

- Payment API :
    Retrieving payment list
        method: GET
        endpoint : ```/payment```
    
    Retrieving payment by id
        method: GET
        endpoint : ```/payment/{payment_id}```

    Insert payment to database
        method: POST
        endpoint : ```/payment{invoice_id}//store```
        form-data : {
            payment_method: enum [transfer, cc, shopee, tokopedia],
        }

    Update payment from database
        method: POST
        endpoint : ```/payment/{payment_id}/update```
        form-data : {
            payment_method: enum [transfer, cc, shopee, tokopedia],
            status: enum [pending, paid, cancelled],
        }

    Upload receipt
        method: POST
        endpoint : ```/payment/{payment_id}/upload```
        form-data : {
            file: file,
        }

    Delete payment from database
        method: DELETE
        endpoint : ```/payment/{payment_id}```

- Production API :
    Retrieving production list
        method: GET
        endpoint : ```/production```
    
    Retrieving production by id
        method: GET
        endpoint : ```/production/{production_id}```

    Insert production to database
        method: POST
        endpoint : ```/production{invoice_id}//store```
        form-data : {
            status: enum [designing, confirmed, printing, ready, shipping, arrived],
            notes: string,
            received_at: datetime,
            produced_at: datetime,
            finished_at: datetime
        }

    Update production from database
        method: POST
        endpoint : ```/production/{production_id}/update```
        form-data : {
            status: enum [designing, confirmed, printing, ready, shipping, arrived],
            notes: string,
            received_at: datetime,
            produced_at: datetime,
            finished_at: datetime
        }

    Delete production from database
        method: DELETE
        endpoint : ```/production/{production_id}```



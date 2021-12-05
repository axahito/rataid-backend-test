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
    Retrieving item list <br/>
        method: GET <br/>
        endpoint : ```/item``` <br/>
    
    Retrieving item by id <br/>
        method: GET <br/>
        endpoint : ```/item/{item_id}``` <br/>

    Insert item to database <br/>
        method: POST <br/>
        endpoint : ```/item/store``` <br/>
        form-data : { <br/>
            name: string, <br/>
            price: integer <br/>
        } <br/>

    Update item from database <br/>
        method: POST <br/>
        endpoint : ```/item/{item_id}/update``` <br/>
        form-data : { <br/>
            name: string, <br/>
            price: integer <br/>
        } <br/>
 
    Delete item from database <br/>
        method: DELETE <br/>
        endpoint : ```/item/{item_id}``` <br/>

- Customer API : <br/>
    Retrieving customer list <br/>
        method: GET <br/>
        endpoint : ```/customer``` <br/>
    
    Retrieving customer by id <br/>
        method: GET <br/>
        endpoint : ```/customer/{customer_id}``` <br/>

    Insert customer to database <br/>
        method: POST <br/>
        endpoint : ```/customer/store``` <br/>
        form-data : { <br/>
            name: string, <br/>
            address: string <br/>
        } <br/>

    Update customer from database <br/>
        method: POST <br/>
        endpoint : ```/customer/{customer_id}/update``` <br/>
        form-data : { <br/>
            name: string, <br/>
            address: string <br/>
        }

    Delete customer from database <br/>
        method: DELETE <br/>
        endpoint : ```/customer/{customer_id}``` <br/>

- Invoice API : <br/>
    Retrieving invoice list <br/>
        method: GET <br/>
        endpoint : ```/invoice``` <br/>
     
    Retrieving invoice by id <br/>
        method: GET <br/>
        endpoint : ```/invoice/{invoice_id}``` <br/>

    Insert invoice to database  <br/>
        method: POST <br/>
        endpoint : ```/invoice/store``` <br/>
        form-data : { <br/>
            qty: integer, <br/>
            item_id: integer, <br/>
            customer_id: integer <br/>
        } <br/>

    Update invoice from database <br/>
        method: POST <br/>
        endpoint : ```/invoice/{invoice_id}/update``` <br/>
        form-data : { <br/>
            qty: integer, <br/>
            item_id: integer, <br/>
            customer_id: integer <br/>
        } <br/>

    Delete invoice from database <br/>
        method: DELETE <br/>
        endpoint : ```/invoice/{invoice_id}``` <br/>

- Payment API :<br/> 
    Retrieving payment list <br/>
        method: GET <br/>
        endpoint : ```/payment``` <br/>
    
    Retrieving payment by id <br/>
        method: GET <br/>
        endpoint : ```/payment/{payment_id}``` <br/>

    Insert payment to database <br/>
        method: POST <br/>
        endpoint : ```/payment{invoice_id}//store``` <br/>
        form-data : {<br/>
            payment_method: enum [transfer, cc, shopee, tokopedia],  <br/>
        } <br/>

    Update payment from database <br/>
        method: POST <br/>
        endpoint : ```/payment/{payment_id}/update``` <br/>
        form-data : { <br/>
            payment_method: enum [transfer, cc, shopee, tokopedia], <br/>
            status: enum [pending, paid, cancelled], <br/>
        } <br/>

    Upload receipt <br/>
        method: POST <br/>
        endpoint : ```/payment/{payment_id}/upload``` <br/>
        form-data : { <br/>
            file: file, <br/>
        } <br/>
 
    Delete payment from database <br/>
        method: DELETE <br/>
        endpoint : ```/payment/{payment_id}```<br/>

- Production API : <br/>
    Retrieving production list <br/>
        method: GET <br/>
        endpoint : ```/production``` <br/>
    
    Retrieving production by id <br/>
        method: GET <br/>
        endpoint : ```/production/{production_id}``` <br/>

    Insert production to database<br/>
        method: POST <br/>
        endpoint : ```/production{invoice_id}//store``` <br/>
        form-data : { <br/>
            status: enum [designing, confirmed, printing, ready, shipping, arrived], <br/>
            notes: string, <br/>
            received_at: datetime, <br/>
            produced_at: datetime, <br/>
            finished_at: datetime <br/>
        } <br/>

    Update production from database <br/>
        method: POST<br/>
        endpoint : ```/production/{production_id}/update``` <br/>
        form-data : { <br/>
            status: enum [designing, confirmed, printing, ready, shipping, arrived], <br/>
            notes: string, <br/>
            received_at: datetime, <br/>
            produced_at: datetime, <br/>
            finished_at: datetime <br/>
        } <br/>

    Delete production from database <br/> 
        method: DELETE <br/>
        endpoint : ```/production/{production_id}``` <br/>



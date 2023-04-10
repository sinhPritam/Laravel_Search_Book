/* search page */

    http://127.0.0.1:8000/    // search page
    http://127.0.0.1:8000/search_page  // search page

 //  searchng the data usiing scout //
        http://127.0.0.1:8000/search_page?search=value

// Prduct page where all the records are listed //
        http://127.0.0.1:8000/product

// get the perticular products replace {productId} with actual id//
        http://127.0.0.1:8000/product/{productId}     


/* Product CRUD */

// return html page to fill the product details
        http://127.0.0.1:8000/product/create 

// store the product details in the database
        http://127.0.0.1:8000/product/store   
         body_parameters = {
            'title',  // title is required
            'author', // author is required 
            'description',
            'isbn'
            'genre'
            'published'
            'publisher'
            'image'
        }

// return html page to fill the prefil values of the product.
        http://127.0.0.1:8000/product/edit/id   


// update the product details in the database

        http://127.0.0.1:8000/product/update  

        body_parameters = {
            'title',  // title is required
            'author', // author is required 
            'description',
            'isbn'
            'genre'
            'published'
            'publisher'
            'image'
        }

// delete the product details in the database

        http://127.0.0.1:8000/product/delete   

        body_parameters = {
            'id',
        }


/*    Project setup      */        

compposer install or update.
php artisan migrate
php artisan db:seed

cretedential

    user => Email Addres: test@gmail.com
            Password: Test105*

    Admin => Email Addres: admin@gmail.com
            Password: Test105*

